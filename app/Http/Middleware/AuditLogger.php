<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuditLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $startTime = microtime(true);

        $response = $next($request);

        $endTime = microtime(true);
        $duration = round(($endTime - $startTime) * 1000, 2); // milliseconds

        // Log security-related events
        $this->logSecurityEvent($request, $response, $duration);

        return $response;
    }

    /**
     * Log security-related events
     */
    private function logSecurityEvent(Request $request, $response, $duration)
    {
        $user = Auth::user();
        $userId = $user ? $user->id : 'guest';
        $userRole = $user ? $user->role : 'guest';

        $logData = [
            'timestamp' => now()->toISOString(),
            'user_id' => $userId,
            'user_role' => $userRole,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'route' => $request->route() ? $request->route()->getName() : 'unknown',
            'status_code' => $response->getStatusCode(),
            'response_time_ms' => $duration,
            'request_size' => strlen($request->getContent()),
        ];

        // Log sensitive operations
        $sensitiveRoutes = [
            'admin.users.',
            'admin.transaksi.',
            'password.',
            'login',
            'logout'
        ];

        $isSensitive = false;
        foreach ($sensitiveRoutes as $route) {
            if (strpos($logData['route'], $route) !== false) {
                $isSensitive = true;
                break;
            }
        }

        if ($isSensitive || $response->getStatusCode() >= 400) {
            Log::channel('security')->info('Security Event', $logData);
        }

        // Log failed authentication attempts
        if ($response->getStatusCode() === 422 && $request->is('login')) {
            Log::channel('security')->warning('Failed Login Attempt', [
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'attempted_nim' => $request->input('nim'),
                'timestamp' => now()->toISOString(),
            ]);
        }

        // Log suspicious activities
        if ($this->isSuspiciousActivity($request)) {
            Log::channel('security')->alert('Suspicious Activity Detected', $logData);
        }
    }

    /**
     * Check for suspicious activity patterns
     */
    private function isSuspiciousActivity(Request $request)
    {
        // Check for SQL injection patterns
        $sqlPatterns = ['union', 'select', 'insert', 'update', 'delete', 'drop', 'script', 'javascript:'];
        $queryString = strtolower($request->getQueryString() ?? '');

        foreach ($sqlPatterns as $pattern) {
            if (strpos($queryString, $pattern) !== false) {
                return true;
            }
        }

        // Check for XSS patterns
        $xssPatterns = ['<script', 'javascript:', 'onload=', 'onerror=', 'onclick='];
        $inputData = json_encode($request->all());

        foreach ($xssPatterns as $pattern) {
            if (strpos(strtolower($inputData), $pattern) !== false) {
                return true;
            }
        }

        return false;
    }
}

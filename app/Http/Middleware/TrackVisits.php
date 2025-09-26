<?php

namespace App\Http\Middleware;

use Closure;
use App\Visit;
use Illuminate\Support\Facades\Cache;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Only track GET requests and exclude admin routes, API routes, and static assets
        if ($request->isMethod('get') &&
            !$this->isAdminRoute($request) &&
            !$this->isApiRoute($request) &&
            !$this->isStaticAsset($request) &&
            !$this->isBot($request)) {

            $this->trackVisit($request);
        }

        return $response;
    }

    /**
     * Track the visit asynchronously
     */
    private function trackVisit($request)
    {
        $ipAddress = $request->ip();
        $sessionId = session()->getId();
        $pageUrl = $request->fullUrl();
        $userAgent = $request->userAgent();
        $referrer = $request->header('referer');

        // Use cache to prevent duplicate tracking within a short time frame
        $cacheKey = 'visit_' . md5($ipAddress . $sessionId . $pageUrl);
        $cacheTime = 300; // 5 minutes

        if (!Cache::has($cacheKey)) {
            try {
                Visit::create([
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                    'page_url' => $pageUrl,
                    'referrer' => $referrer,
                    'session_id' => $sessionId,
                    'request_data' => null, // Can be extended to store additional data
                    'visited_at' => now()
                ]);

                Cache::put($cacheKey, true, $cacheTime);
            } catch (\Exception $e) {
                // Log error but don't interrupt the response
                \Log::error('Failed to track visit: ' . $e->getMessage());
            }
        }
    }

    /**
     * Check if the route is an admin route
     */
    private function isAdminRoute($request)
    {
        return $request->is('admin/*') || $request->is('admin');
    }

    /**
     * Check if the route is an API route
     */
    private function isApiRoute($request)
    {
        return $request->is('api/*') || $request->is('api');
    }

    /**
     * Check if the request is for static assets
     */
    private function isStaticAsset($request)
    {
        $path = $request->path();
        $extensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'ico', 'svg', 'woff', 'woff2', 'ttf', 'eot'];

        foreach ($extensions as $ext) {
            if (str_ends_with($path, '.' . $ext)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the request is from a bot
     */
    private function isBot($request)
    {
        $userAgent = strtolower($request->userAgent());

        $bots = [
            'googlebot',
            'bingbot',
            'slurp',
            'duckduckbot',
            'baiduspider',
            'yandexbot',
            'facebookexternalhit',
            'twitterbot',
            'linkedinbot',
            'whatsapp',
            'telegrambot'
        ];

        foreach ($bots as $bot) {
            if (str_contains($userAgent, $bot)) {
                return true;
            }
        }

        return false;
    }
}

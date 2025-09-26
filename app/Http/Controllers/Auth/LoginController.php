<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    use \Illuminate\Foundation\Auth\ThrottlesLogins;

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected function redirectTo()
    {
        $user = auth()->user();
        
        // Admin roles redirect to admin panel
        if ($user->isAnyAdmin()) {
            return '/admin';
        }
        
        // Regular users redirect to home
        return '/';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'login_field'; // We'll use a dynamic field
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Rate limiting to prevent brute force attacks
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $this->clearLoginAttempts($request);
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login_field' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $loginField = $request->input('login_field');
        $password = $request->input('password');

        // Determine if login field is email or NIM
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';
        
        $credentials = [
            $fieldType => $loginField,
            'password' => $password
        ];

        // Check if user exists and is active
        $user = User::where($fieldType, $loginField)->first();

        if (!$user) {
            return false;
        }

        if ($user->status !== User::STATUS_ACTIVE) {
            // Store user for error message
            $request->merge(['found_user' => $user]);
            return false;
        }

        return $this->guard()->attempt($credentials, $request->filled('remember'));
    }

    protected function credentials(Request $request)
    {
        $loginField = $request->input('login_field');
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';
        
        return [
            $fieldType => $loginField,
            'password' => $request->input('password')
        ];
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $loginField = $request->input('login_field');
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';
        
        // Check if user exists but is inactive
        $user = User::where($fieldType, $loginField)->first();

        if ($user && $user->status !== User::STATUS_ACTIVE) {
            $message = 'Akun Anda ';
            
            if ($user->status === User::STATUS_INACTIVE) {
                $message .= 'sedang menunggu persetujuan admin. Silakan hubungi administrator.';
            } elseif ($user->status === User::STATUS_REJECTED) {
                $message .= 'telah ditolak. Silakan hubungi administrator untuk informasi lebih lanjut.';
            }
            
            return redirect()->back()
                ->withInput($request->only('login_field', 'remember'))
                ->withErrors([
                    'login_field' => $message,
                ]);
        }

        return redirect()->back()
            ->withInput($request->only('login_field', 'remember'))
            ->withErrors([
                'login_field' => 'Email/NIM atau password salah.',
            ]);
    }

    protected function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

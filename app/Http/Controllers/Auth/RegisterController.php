<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        return '/pending-approval';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Show registration form for umum
     */
    public function showUmumRegistrationForm()
    {
        return view('auth.register-umum');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    /**
     * Register umum user
     */
    public function registerUmum(Request $request)
    {
        $setting = Setting::first();
        if (!$setting || !$setting->registration_enabled) {
            return redirect()->back()->withErrors(['registration' => 'Pendaftaran pengguna sedang dinonaktifkan.'])->withInput();
        }

        $this->validatorUmum($request->all())->validate();

        $user = $this->createUmum($request->all());

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    protected function redirectPath()
    {
        return $this->redirectTo();
    }

    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Get a validator for umum registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorUmum(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'whatsapp' => ['nullable', 'string', 'max:20', 'regex:/^([0-9+\-\s]+)$/'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'nim' => $data['nim'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_REGULAR,
            'status' => User::STATUS_INACTIVE,
            'user_type' => User::USER_TYPE_UMUM
        ]);
    }

    /**
     * Create a new umum user instance.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createUmum(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'nim' => null, // NIM tidak wajib untuk umum
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'whatsapp' => $data['whatsapp'] ?? null,
            'role' => User::ROLE_REGULAR,
            'status' => User::STATUS_INACTIVE, // Umum perlu approval
            'user_type' => User::USER_TYPE_UMUM
        ]);
    }
}

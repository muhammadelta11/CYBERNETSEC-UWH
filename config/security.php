<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Security Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains security-related configuration for the application
    |
    */

    'password' => [
        'min_length' => 12,
        'require_uppercase' => true,
        'require_lowercase' => true,
        'require_numbers' => true,
        'require_symbols' => true,
    ],

    'file_upload' => [
        'max_size' => 2048, // KB
        'allowed_mimes' => ['png', 'jpg', 'jpeg', 'pdf'],
        'scan_for_malware' => true,
    ],

    'rate_limiting' => [
        'login_attempts' => 5,
        'decay_minutes' => 1,
        'lockout_duration' => 15, // minutes
    ],

    'session' => [
        'lifetime' => 720, // minutes (12 hours)
        'secure' => env('SESSION_SECURE_COOKIE', false),
        'http_only' => true,
        'same_site' => 'lax',
    ],

    'headers' => [
        'hsts' => [
            'enabled' => true,
            'max_age' => 31536000, // 1 year
            'include_subdomains' => true,
        ],
        'csp' => [
            'enabled' => true,
            'default_src' => "'self'",
            'script_src' => "'self' 'unsafe-inline' https://code.jquery.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com",
            'style_src' => "'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net",
            'font_src' => "'self' https://fonts.gstatic.com",
            'img_src' => "'self' data: https:",
            'connect_src' => "'self'",
            'frame_ancestors' => "'self'",
        ],
    ],

    'encryption' => [
        'key_rotation' => true,
        'algorithm' => 'AES-256-GCM',
    ],

    'audit' => [
        'enabled' => true,
        'log_sensitive_actions' => true,
        'retention_days' => 365,
    ],

    'cors' => [
        'allowed_origins' => [env('APP_URL')],
        'allowed_headers' => ['*'],
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
        'max_age' => 86400,
    ],
];

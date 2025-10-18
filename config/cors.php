<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

    'allowed_origins' => [
        'https://solomate-ec557z.vercel.app',
        'https://solomate-ec557z-*.vercel.app',
        'https://solomate-ec557z-git-main-mohamedtarek64.vercel.app',
        'http://localhost:3000',
        'http://localhost:8080',
        'http://127.0.0.1:3000',
        'http://127.0.0.1:8080',
        'http://localhost:3001',
        'http://127.0.0.1:3001',
        'http://localhost:5173',  // Vite default port
        'http://127.0.0.1:5173',  // Vite default port
        'http://localhost:4000',  // Alternative frontend port
        'http://127.0.0.1:4000',  // Alternative frontend port
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => [
        'Content-Type',
        'X-Requested-With',
        'Authorization',
        'Accept',
        'Origin',
        'X-CSRF-TOKEN',
    ],

    'exposed_headers' => [
        'X-RateLimit-Limit',
        'X-RateLimit-Remaining',
        'X-RateLimit-Reset',
    ],

    'max_age' => 86400, // 24 hours

    'supports_credentials' => true,

];

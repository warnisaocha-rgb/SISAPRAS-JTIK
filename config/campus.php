<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Integrasi Data Mahasiswa dari Server / IP Kampus
    |--------------------------------------------------------------------------
    | Atur CAMPUS_API_ENABLED=true dan isi CAMPUS_API_BASE_URL dengan IP/URL
    | server kampus saat terhubung ke jaringan kampus. Jika IP kampus belum
    | aktif atau tidak terjangkau dan CAMPUS_API_FALLBACK_LOCAL=true, sistem
    | akan menggunakan data akun mahasiswa yang sudah tersinkron lokal.
    */
    'enabled' => filter_var(env('CAMPUS_API_ENABLED', false), FILTER_VALIDATE_BOOL),
    'base_url' => rtrim((string) env('CAMPUS_API_BASE_URL', 'http://10.0.0.10/api'), '/'),
    'login_endpoint' => env('CAMPUS_API_LOGIN_ENDPOINT', '/mahasiswa/login'),
    'student_endpoint' => env('CAMPUS_API_STUDENT_ENDPOINT', '/mahasiswa'),
    'api_token' => (string) env('CAMPUS_API_TOKEN', ''),
    'timeout' => (int) env('CAMPUS_API_TIMEOUT', 6),
    'fallback_local' => filter_var(env('CAMPUS_API_FALLBACK_LOCAL', true), FILTER_VALIDATE_BOOL),
];

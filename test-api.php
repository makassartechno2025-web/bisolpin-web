<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$res = \Illuminate\Support\Facades\Http::post('https://admin.bisolpin.com/api/auth/google-login', [
    'access_token' => 'invalid_token_test'
]);

var_dump($res->status());
print_r($res->json());

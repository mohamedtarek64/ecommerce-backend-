<?php

// Simple API testing script
function testEndpoint($url, $method = 'GET', $data = null, $headers = []) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([
        'Content-Type: application/json',
        'Accept: application/json'
    ], $headers));

    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);

    curl_close($ch);

    return [
        'url' => $url,
        'method' => $method,
        'http_code' => $httpCode,
        'response' => $response,
        'error' => $error
    ];
}

echo "=== API Testing Report ===\n\n";

// Test basic endpoints
echo "1. BASIC ENDPOINTS:\n";
$tests = [
    ['GET', 'http://localhost:8000/api/health'],
    ['GET', 'http://localhost:8000/api/status'],
    ['GET', 'http://localhost:8000/api/simple-test'],
    ['GET', 'http://localhost:8000/api/db-status'],
];

foreach ($tests as $test) {
    $result = testEndpoint($test[1], $test[0]);
    $status = $result['http_code'] == 200 ? '✅' : '❌';
    echo "{$status} {$test[0]} {$test[1]} - HTTP {$result['http_code']}\n";
}

echo "\n2. AUTHENTICATION ENDPOINTS:\n";
$authTests = [
    ['POST', 'http://localhost:8000/api/auth/login', ['email' => 'admin@solemate.com', 'password' => 'password']],
    ['POST', 'http://localhost:8000/api/auth/register', ['name' => 'Test User', 'email' => 'test@test.com', 'password' => 'password', 'password_confirmation' => 'password']],
];

foreach ($authTests as $test) {
    $result = testEndpoint($test[1], $test[0], $test[2] ?? null);
    $status = $result['http_code'] == 200 ? '✅' : '❌';
    echo "{$status} {$test[0]} {$test[1]} - HTTP {$result['http_code']}\n";
    if ($result['http_code'] != 200) {
        echo "   Response: " . substr($result['response'], 0, 100) . "...\n";
    }
}

echo "\n3. PRODUCT ENDPOINTS:\n";
$productTests = [
    ['GET', 'http://localhost:8000/api/products/1'],
    ['GET', 'http://localhost:8000/api/search/products'],
];

foreach ($productTests as $test) {
    $result = testEndpoint($test[1], $test[0]);
    $status = $result['http_code'] == 200 ? '✅' : '❌';
    echo "{$status} {$test[0]} {$test[1]} - HTTP {$result['http_code']}\n";
}

echo "\n4. CART ENDPOINTS:\n";
$cartTests = [
    ['GET', 'http://localhost:8000/api/cart/'],
    ['GET', 'http://localhost:8000/api/cart/count'],
];

foreach ($cartTests as $test) {
    $result = testEndpoint($test[1], $test[0]);
    $status = $result['http_code'] == 200 ? '✅' : '❌';
    echo "{$status} {$test[0]} {$test[1]} - HTTP {$result['http_code']}\n";
}

echo "\n5. ADMIN ENDPOINTS:\n";
$adminTests = [
    ['GET', 'http://localhost:8000/api/admin/products'],
    ['GET', 'http://localhost:8000/api/admin/orders'],
    ['GET', 'http://localhost:8000/api/admin/customers'],
];

foreach ($adminTests as $test) {
    $result = testEndpoint($test[1], $test[0]);
    $status = $result['http_code'] == 200 ? '✅' : '❌';
    echo "{$status} {$test[0]} {$test[1]} - HTTP {$result['http_code']}\n";
}

echo "\n=== Testing Complete ===\n";

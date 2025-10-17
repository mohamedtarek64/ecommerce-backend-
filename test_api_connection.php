<?php

echo "🧪 Testing Railway Backend API Connection\n\n";

// Your Railway Backend URL
$backendUrl = "https://helpful-creation-production.up.railway.app";

echo "📡 Testing API Endpoints...\n\n";

// Test endpoints
$endpoints = [
    '/api/products' => 'Products',
    '/api/categories' => 'Categories',
    '/api/brands' => 'Brands',
];

foreach ($endpoints as $endpoint => $name) {
    echo "Testing $name ($endpoint)...\n";
    
    $url = $backendUrl . $endpoint;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        echo "  ❌ Error: $error\n\n";
        continue;
    }
    
    if ($httpCode === 200) {
        $data = json_decode($response, true);
        if (isset($data['data'])) {
            $count = count($data['data']);
            echo "  ✅ Success! Found $count records\n";
            
            // Show first record
            if ($count > 0) {
                echo "  📝 Sample record:\n";
                echo "     " . json_encode($data['data'][0], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
            }
        } else {
            echo "  ⚠️ Success but unexpected format\n";
            echo "  Response: " . substr($response, 0, 200) . "...\n";
        }
    } else {
        echo "  ❌ HTTP $httpCode\n";
        echo "  Response: " . substr($response, 0, 200) . "...\n";
    }
    
    echo "\n";
}

echo "✅ API Test Complete!\n";


<?php

echo "🔍 Checking Railway Database Data\n\n";

// Railway Database Credentials
$host = 'centerbeam.proxy.rlwy.net';
$port = '34219';
$database = 'railway';
$username = 'root';
$password = 'dnGTucLuCwRIpgnDntPSgOCRQfRDQtQS';

echo "📊 Connecting to Railway MySQL...\n";
echo "Host: $host:$port\n";
echo "Database: $database\n\n";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Connected successfully!\n\n";

    // List all tables
    echo "📋 Tables in database:\n";
    echo str_repeat("=", 60) . "\n";

    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (empty($tables)) {
        echo "❌ No tables found in database!\n";
        exit(1);
    }

    echo "Found " . count($tables) . " tables:\n\n";

    $totalRecords = 0;

    foreach ($tables as $table) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM `$table`");
        $count = $stmt->fetchColumn();
        $totalRecords += $count;

        $emoji = $count > 0 ? "✅" : "⚠️";
        echo sprintf("%s %-30s: %5d records\n", $emoji, $table, $count);
    }

    echo "\n" . str_repeat("=", 60) . "\n";
    echo "📊 Total Records: $totalRecords\n\n";

    // Show sample data from important tables
    $importantTables = ['users', 'products', 'categories', 'brands'];

    foreach ($importantTables as $table) {
        if (in_array($table, $tables)) {
            echo "\n🔍 Sample data from `$table`:\n";
            echo str_repeat("-", 60) . "\n";

            $stmt = $pdo->query("SELECT * FROM `$table` LIMIT 3");
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                foreach ($data as $row) {
                    echo json_encode($row, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
                }
            } else {
                echo "No data found.\n";
            }
        }
    }

    echo "\n✅ Database check complete!\n";

} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n\n";
    echo "💡 Make sure you update the connection details at the top of this file:\n";
    echo "   - Get RAILWAY_TCP_PROXY_DOMAIN from Railway Dashboard\n";
    echo "   - Get RAILWAY_TCP_PROXY_PORT from Railway Dashboard\n";
    echo "   - Use your MySQL password\n";
    exit(1);
}

<?php

echo "🚀 Railway Database Export Tool\n\n";

// Railway Database Connection from Environment Variables
// Try Laravel's DB_ variables first, then Railway's MYSQL variables
$host = getenv('DB_HOST') ?: getenv('MYSQLHOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: getenv('MYSQLPORT') ?: '3306';
$database = getenv('DB_DATABASE') ?: getenv('MYSQLDATABASE') ?: 'railway';
$username = getenv('DB_USERNAME') ?: getenv('MYSQLUSER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: '';

echo "📊 Connecting to Railway MySQL...\n";
echo "Host: $host\n";
echo "Database: $database\n";
echo "Username: $username\n\n";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Connected successfully!\n\n";

    // Create exports directory
    $exportDir = 'railway_exports';
    if (!is_dir($exportDir)) {
        mkdir($exportDir, 0755, true);
    }

    $timestamp = date('Y-m-d_H-i-s');
    $exportFile = "$exportDir/railway_export_$timestamp.json";

    $exportData = [];

    // Get all tables
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    echo "📋 Found " . count($tables) . " tables:\n";

    foreach ($tables as $table) {
        echo "📊 Exporting $table...\n";

        $stmt = $pdo->query("SELECT * FROM `$table`");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $exportData[$table] = $data;

        echo "✅ Exported " . count($data) . " records from $table\n";
    }

    // Add metadata
    $exportData['_metadata'] = [
        'exported_at' => date('Y-m-d H:i:s'),
        'total_tables' => count($tables),
        'total_records' => array_sum(array_map('count', array_filter($exportData, function($key) {
            return $key !== '_metadata';
        }, ARRAY_FILTER_USE_KEY)))
    ];

    // Save to JSON
    echo "\n💾 Saving to file...\n";
    file_put_contents($exportFile, json_encode($exportData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "✅ Export completed!\n";
    echo "📁 File: $exportFile\n";
    echo "📊 Total records: " . $exportData['_metadata']['total_records'] . "\n";

    // Create summary
    $summaryFile = "$exportDir/export_summary_$timestamp.txt";
    $summary = "RAILWAY EXPORT SUMMARY\n";
    $summary .= "====================\n\n";
    $summary .= "Export Date: " . $exportData['_metadata']['exported_at'] . "\n";
    $summary .= "Total Tables: " . $exportData['_metadata']['total_tables'] . "\n";
    $summary .= "Total Records: " . $exportData['_metadata']['total_records'] . "\n\n";

    $summary .= "TABLE BREAKDOWN:\n";
    $summary .= "===============\n";
    foreach ($exportData as $table => $data) {
        if ($table !== '_metadata') {
            $count = count($data);
            $summary .= sprintf("%-25s: %d records\n", $table, $count);
        }
    }

    file_put_contents($summaryFile, $summary);
    echo "📋 Summary: $summaryFile\n";

} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    echo "\n💡 Make sure environment variables are set correctly.\n";

    echo "\n🔍 Current Environment Variables:\n";
    echo "DB_HOST: " . (getenv('DB_HOST') ?: 'NOT SET') . "\n";
    echo "DB_PORT: " . (getenv('DB_PORT') ?: 'NOT SET') . "\n";
    echo "DB_DATABASE: " . (getenv('DB_DATABASE') ?: 'NOT SET') . "\n";
    echo "DB_USERNAME: " . (getenv('DB_USERNAME') ?: 'NOT SET') . "\n";
    echo "DB_PASSWORD: " . (getenv('DB_PASSWORD') ? 'SET' : 'NOT SET') . "\n";
    echo "\nMYSQLHOST: " . (getenv('MYSQLHOST') ?: 'NOT SET') . "\n";
    echo "MYSQLPORT: " . (getenv('MYSQLPORT') ?: 'NOT SET') . "\n";
    echo "MYSQLDATABASE: " . (getenv('MYSQLDATABASE') ?: 'NOT SET') . "\n";
    echo "MYSQLUSER: " . (getenv('MYSQLUSER') ?: 'NOT SET') . "\n";
    echo "MYSQLPASSWORD: " . (getenv('MYSQLPASSWORD') ? 'SET' : 'NOT SET') . "\n";
    
    echo "\n⚠️ Export skipped due to connection error, but app will continue running.\n";
}

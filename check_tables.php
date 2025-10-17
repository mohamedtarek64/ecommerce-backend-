<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔍 Checking available tables...\n\n";

try {
    $tables = DB::select('SHOW TABLES');

    echo "📋 Available Tables:\n";
    echo "===================\n";

    foreach ($tables as $table) {
        $tableName = array_values((array)$table)[0];
        $count = DB::table($tableName)->count();
        echo sprintf("%-30s: %d records\n", $tableName, $count);
    }

    echo "\n✅ Total tables: " . count($tables) . "\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

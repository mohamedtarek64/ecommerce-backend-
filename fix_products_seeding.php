<?php

echo "🔧 Fixing Products Seeding - Adding data to specific product tables\n\n";

// Railway Database Connection
$host = 'centerbeam.proxy.rlwy.net';
$port = '34219';
$database = 'railway';
$username = 'root';
$password = 'dnGTucLuCwRIpgnDntPSgOCRQfRDQtQS';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connected to Railway MySQL!\n\n";
    
    // Get products from main products table
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "📋 Found " . count($products) . " products in main table\n\n";
    
    $insertedCount = 0;
    
    foreach ($products as $product) {
        $category = strtolower($product['category']);
        $tableName = '';
        
        // Determine which table to insert into
        switch ($category) {
            case 'kids':
                $tableName = 'products_kids';
                break;
            case 'men':
                $tableName = 'products_men';
                break;
            case 'women':
                $tableName = 'products_women';
                break;
            default:
                echo "⚠️ Unknown category: {$product['category']} for product: {$product['name']}\n";
                continue 2;
        }
        
        // Check if table exists
        $stmt = $pdo->query("SHOW TABLES LIKE '$tableName'");
        if ($stmt->rowCount() == 0) {
            echo "⚠️ Table `$tableName` doesn't exist, skipping...\n";
            continue;
        }
        
        // Check if product already exists in the specific table
        $stmt = $pdo->prepare("SELECT id FROM `$tableName` WHERE name = ?");
        $stmt->execute([$product['name']]);
        
        if ($stmt->rowCount() > 0) {
            echo "⚠️ Product '{$product['name']}' already exists in `$tableName`\n";
            continue;
        }
        
        // Prepare data for insertion (remove id to avoid conflicts)
        $insertData = $product;
        unset($insertData['id']);
        
        // Insert into specific table
        $columns = implode(', ', array_keys($insertData));
        $placeholders = ':' . implode(', :', array_keys($insertData));
        
        $sql = "INSERT INTO `$tableName` ($columns) VALUES ($placeholders)";
        $stmt = $pdo->prepare($sql);
        
        try {
            $stmt->execute($insertData);
            echo "✅ Added '{$product['name']}' to `$tableName`\n";
            $insertedCount++;
        } catch (PDOException $e) {
            echo "❌ Error adding '{$product['name']}' to `$tableName`: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n🎉 Fix completed!\n";
    echo "📊 Total products moved: $insertedCount\n\n";
    
    // Verify results
    echo "🔍 Verifying results...\n";
    $tables = ['products_kids', 'products_men', 'products_women'];
    
    foreach ($tables as $table) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM `$table`");
        $count = $stmt->fetchColumn();
        echo "📋 `$table`: $count records\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n✅ Products seeding fix complete!\n";

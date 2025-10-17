<?php

echo "🔧 Fixing Products Seeding V2 - Adding data to specific product tables\n\n";

// Railway Database Connection - Try internal connection first
$host = 'mysql.railway.internal';
$port = '3306';
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

        // Get table structure to see what columns exist
        $stmt = $pdo->query("DESCRIBE `$tableName`");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

        echo "📋 Columns in `$tableName`: " . implode(', ', $columns) . "\n";

        // Check if product already exists in the specific table
        $stmt = $pdo->prepare("SELECT id FROM `$tableName` WHERE title = ? OR product_name = ?");
        $stmt->execute([$product['name'], $product['name']]);

        if ($stmt->rowCount() > 0) {
            echo "⚠️ Product '{$product['name']}' already exists in `$tableName`\n";
            continue;
        }

        // Prepare data based on available columns
        $insertData = [];

        // Map main table columns to specific table columns
        $columnMapping = [
            'title' => $product['name'],
            'product_name' => $product['name'],
            'name' => $product['name'],
            'description' => $product['description'] ?? '',
            'price' => $product['price'] ?? 0,
            'original_price' => $product['original_price'] ?? $product['price'] ?? 0,
            'discount_percentage' => $product['discount_percentage'] ?? 0,
            'sku' => $product['sku'] ?? '',
            'brand' => $product['brand'] ?? '',
            'category' => $product['category'] ?? '',
            'material' => $product['material'] ?? '',
            'care_instructions' => $product['care_instructions'] ?? '',
            'origin' => $product['origin'] ?? '',
            'colors' => $product['colors'] ?? '[]',
            'sizes' => $product['sizes'] ?? '[]',
            'images' => $product['images'] ?? '[]',
            'is_active' => $product['is_active'] ?? 1,
            'is_featured' => $product['is_featured'] ?? 0,
            'stock_quantity' => $product['stock_quantity'] ?? 0,
            'is_available' => $product['is_available'] ?? 1,
            'rating' => $product['rating'] ?? 0.0,
            'reviews_count' => $product['reviews_count'] ?? 0,
            'created_at' => $product['created_at'] ?? date('Y-m-d H:i:s'),
            'updated_at' => $product['updated_at'] ?? date('Y-m-d H:i:s')
        ];

        // Only include columns that exist in the target table
        foreach ($columnMapping as $column => $value) {
            if (in_array($column, $columns)) {
                $insertData[$column] = $value;
            }
        }

        if (empty($insertData)) {
            echo "⚠️ No matching columns found for `$tableName`\n";
            continue;
        }

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

        // Show sample data
        if ($count > 0) {
            $stmt = $pdo->query("SELECT * FROM `$table` LIMIT 1");
            $sample = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "   Sample: " . ($sample['title'] ?? $sample['product_name'] ?? $sample['name'] ?? 'Unknown') . "\n";
        }
    }

} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n✅ Products seeding fix complete!\n";

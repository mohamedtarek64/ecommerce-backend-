<?php

echo "🌱 Seeding Products Tables - Adding data to specific product tables\n\n";

// Railway Database Connection
$host = 'mysql.railway.internal';
$port = '3306';
$database = 'railway';
$username = 'root';
$password = 'dnGTucLuCwRIpgnDntPSgOCRQfRDQtQS';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connected to Railway MySQL!\n\n";
    
    // Sample data for each table
    $sampleData = [
        'products_kids' => [
            [
                'title' => 'Nike Air Max 270 Kids',
                'description' => 'High-performance running shoes with Air Max technology for kids.',
                'price' => 89.99,
                'original_price' => 99.99,
                'discount_percentage' => 10,
                'sku' => 'SKU-NIKE-KIDS-001',
                'brand' => 'Nike',
                'category' => 'kids',
                'material' => 'Mesh Upper, Rubber Sole',
                'care_instructions' => 'Clean with damp cloth, air dry',
                'origin' => 'Made in Vietnam',
                'colors' => json_encode([
                    ['name' => 'Black', 'color' => 'bg-gray-900'],
                    ['name' => 'White', 'color' => 'bg-white'],
                    ['name' => 'Red', 'color' => 'bg-red-600']
                ]),
                'sizes' => json_encode(['28', '29', '30', '31', '32', '33', '34', '35', '36']),
                'images' => json_encode([
                    'https://via.placeholder.com/400x400/FF0000/FFFFFF?text=Nike+Kids',
                    'https://via.placeholder.com/400x400/0000FF/FFFFFF?text=Nike+Kids+2'
                ]),
                'is_active' => 1,
                'is_featured' => 1,
                'stock_quantity' => 25,
                'is_available' => 1,
                'rating' => 4.5,
                'reviews_count' => 12,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Adidas Ultraboost Kids',
                'description' => 'Revolutionary running shoes with Boost technology for kids.',
                'price' => 79.99,
                'original_price' => 89.99,
                'discount_percentage' => 11,
                'sku' => 'SKU-ADIDAS-KIDS-001',
                'brand' => 'Adidas',
                'category' => 'kids',
                'material' => 'Primeknit Upper, Boost Midsole',
                'care_instructions' => 'Machine wash cold, air dry',
                'origin' => 'Made in Germany',
                'colors' => json_encode([
                    ['name' => 'Black', 'color' => 'bg-gray-900'],
                    ['name' => 'White', 'color' => 'bg-white'],
                    ['name' => 'Blue', 'color' => 'bg-blue-600']
                ]),
                'sizes' => json_encode(['28', '29', '30', '31', '32', '33', '34', '35', '36']),
                'images' => json_encode([
                    'https://via.placeholder.com/400x400/000000/FFFFFF?text=Adidas+Kids',
                    'https://via.placeholder.com/400x400/333333/FFFFFF?text=Adidas+Kids+2'
                ]),
                'is_active' => 1,
                'is_featured' => 0,
                'stock_quantity' => 20,
                'is_available' => 1,
                'rating' => 4.2,
                'reviews_count' => 8,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ],
        
        'products_men' => [
            [
                'title' => 'Nike Air Max 270 Men',
                'description' => 'High-performance running shoes with Air Max technology for men.',
                'price' => 149.99,
                'original_price' => 179.99,
                'discount_percentage' => 17,
                'sku' => 'SKU-NIKE-MEN-001',
                'brand' => 'Nike',
                'category' => 'men',
                'material' => 'Mesh Upper, Rubber Sole',
                'care_instructions' => 'Clean with damp cloth, air dry',
                'origin' => 'Made in Vietnam',
                'colors' => json_encode([
                    ['name' => 'Black', 'color' => 'bg-gray-900'],
                    ['name' => 'White', 'color' => 'bg-white'],
                    ['name' => 'Gray', 'color' => 'bg-gray-600']
                ]),
                'sizes' => json_encode(['40', '41', '42', '43', '44', '45', '46', '47', '48']),
                'images' => json_encode([
                    'https://via.placeholder.com/400x400/FF0000/FFFFFF?text=Nike+Men',
                    'https://via.placeholder.com/400x400/0000FF/FFFFFF?text=Nike+Men+2'
                ]),
                'is_active' => 1,
                'is_featured' => 1,
                'stock_quantity' => 35,
                'is_available' => 1,
                'rating' => 4.7,
                'reviews_count' => 25,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Adidas Ultraboost Men',
                'description' => 'Revolutionary running shoes with Boost midsole technology for men.',
                'price' => 189.99,
                'original_price' => 219.99,
                'discount_percentage' => 14,
                'sku' => 'SKU-ADIDAS-MEN-001',
                'brand' => 'Adidas',
                'category' => 'men',
                'material' => 'Primeknit Upper, Boost Midsole',
                'care_instructions' => 'Machine wash cold, air dry',
                'origin' => 'Made in Germany',
                'colors' => json_encode([
                    ['name' => 'Black', 'color' => 'bg-gray-900'],
                    ['name' => 'White', 'color' => 'bg-white'],
                    ['name' => 'Blue', 'color' => 'bg-blue-600']
                ]),
                'sizes' => json_encode(['40', '41', '42', '43', '44', '45', '46', '47', '48']),
                'images' => json_encode([
                    'https://via.placeholder.com/400x400/000000/FFFFFF?text=Adidas+Men',
                    'https://via.placeholder.com/400x400/333333/FFFFFF?text=Adidas+Men+2'
                ]),
                'is_active' => 1,
                'is_featured' => 0,
                'stock_quantity' => 30,
                'is_available' => 1,
                'rating' => 4.8,
                'reviews_count' => 32,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ],
        
        'products_women' => [
            [
                'title' => 'Nike Air Max 270 Women',
                'description' => 'High-performance running shoes with Air Max technology for women.',
                'price' => 129.99,
                'original_price' => 159.99,
                'discount_percentage' => 19,
                'sku' => 'SKU-NIKE-WOMEN-001',
                'brand' => 'Nike',
                'category' => 'women',
                'material' => 'Mesh Upper, Rubber Sole',
                'care_instructions' => 'Clean with damp cloth, air dry',
                'origin' => 'Made in Vietnam',
                'colors' => json_encode([
                    ['name' => 'Pink', 'color' => 'bg-pink-400'],
                    ['name' => 'White', 'color' => 'bg-white'],
                    ['name' => 'Purple', 'color' => 'bg-purple-600']
                ]),
                'sizes' => json_encode(['36', '37', '38', '39', '40', '41', '42', '43']),
                'images' => json_encode([
                    'https://via.placeholder.com/400x400/FF69B4/FFFFFF?text=Nike+Women',
                    'https://via.placeholder.com/400x400/FF1493/FFFFFF?text=Nike+Women+2'
                ]),
                'is_active' => 1,
                'is_featured' => 1,
                'stock_quantity' => 28,
                'is_available' => 1,
                'rating' => 4.6,
                'reviews_count' => 18,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Puma RS-X Women',
                'description' => 'Bold and futuristic sneakers with chunky sole design for women.',
                'price' => 99.99,
                'original_price' => 119.99,
                'discount_percentage' => 17,
                'sku' => 'SKU-PUMA-WOMEN-001',
                'brand' => 'Puma',
                'category' => 'women',
                'material' => 'Textile Upper, Rubber Sole',
                'care_instructions' => 'Clean with damp cloth, air dry',
                'origin' => 'Made in China',
                'colors' => json_encode([
                    ['name' => 'Pink', 'color' => 'bg-pink-400'],
                    ['name' => 'White', 'color' => 'bg-white'],
                    ['name' => 'Black', 'color' => 'bg-gray-900']
                ]),
                'sizes' => json_encode(['36', '37', '38', '39', '40', '41', '42', '43']),
                'images' => json_encode([
                    'https://via.placeholder.com/400x400/FF6B35/FFFFFF?text=Puma+Women',
                    'https://via.placeholder.com/400x400/2C3E50/FFFFFF?text=Puma+Women+2'
                ]),
                'is_active' => 1,
                'is_featured' => 1,
                'stock_quantity' => 22,
                'is_available' => 1,
                'rating' => 4.4,
                'reviews_count' => 15,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]
    ];
    
    $totalInserted = 0;
    
    foreach ($sampleData as $table => $records) {
        echo "📝 Inserting data into `$table`...\n";
        
        // Check if table exists
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() == 0) {
            echo "  ⚠️ Table `$table` doesn't exist, skipping...\n\n";
            continue;
        }
        
        $inserted = 0;
        
        foreach ($records as $record) {
            try {
                $columns = implode(', ', array_keys($record));
                $placeholders = ':' . implode(', :', array_keys($record));
                
                $sql = "INSERT INTO `$table` ($columns) VALUES ($placeholders)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($record);
                $inserted++;
                echo "  ✅ Added: {$record['title']}\n";
            } catch (PDOException $e) {
                echo "  ⚠️ Error inserting '{$record['title']}': " . $e->getMessage() . "\n";
            }
        }
        
        echo "  📊 Inserted $inserted records into `$table`\n\n";
        $totalInserted += $inserted;
    }
    
    echo "🎉 Seeding completed!\n";
    echo "📊 Total records inserted: $totalInserted\n\n";
    
    // Verify results
    echo "🔍 Verifying results...\n";
    foreach (array_keys($sampleData) as $table) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM `$table`");
        $count = $stmt->fetchColumn();
        echo "📋 `$table`: $count records\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    echo "\n💡 Make sure you're running this from Railway environment or update connection details.\n";
    exit(1);
}

echo "\n✅ Products tables seeding complete!\n";

<?php

echo "🚀 Importing Data to Railway MySQL Database\n\n";

// Railway Database Connection
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
    
    // Sample data to import
    $sampleData = [
        'users' => [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'phone' => '+1234567890',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face',
                'role' => 'admin',
                'status' => 'active',
                'two_factor_enabled' => 0,
                'last_login_at' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'phone' => '+1234567891',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',
                'role' => 'user',
                'status' => 'active',
                'two_factor_enabled' => 0,
                'last_login_at' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ],
        
        'categories' => [
            [
                'name' => 'Men',
                'slug' => 'men',
                'description' => 'Men Category',
                'image' => null,
                'parent_id' => null,
                'sort_order' => 0,
                'is_active' => 1,
                'is_featured' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Women',
                'slug' => 'women',
                'description' => 'Women Category',
                'image' => null,
                'parent_id' => null,
                'sort_order' => 0,
                'is_active' => 1,
                'is_featured' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Kids',
                'slug' => 'kids',
                'description' => 'Kids Category',
                'image' => null,
                'parent_id' => null,
                'sort_order' => 0,
                'is_active' => 1,
                'is_featured' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ],
        
        'brands' => [
            [
                'name' => 'Nike',
                'slug' => 'nike',
                'description' => null,
                'logo' => null,
                'website' => null,
                'is_active' => 1,
                'is_featured' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Adidas',
                'slug' => 'adidas',
                'description' => null,
                'logo' => null,
                'website' => null,
                'is_active' => 1,
                'is_featured' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Puma',
                'slug' => 'puma',
                'description' => null,
                'logo' => null,
                'website' => null,
                'is_active' => 1,
                'is_featured' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ],
        
        'products' => [
            [
                'name' => 'Nike Air Max 270',
                'slug' => 'nike-air-max-270',
                'description' => 'High-performance running shoes with Air Max technology.',
                'price' => 129.99,
                'sku' => 'SKU-NIKE-001',
                'track_quantity' => 1,
                'quantity' => 50,
                'min_quantity' => 1,
                'category_id' => 1,
                'brand_id' => 1,
                'status' => 'active',
                'featured' => 1,
                'images' => json_encode([
                    'https://via.placeholder.com/583x583/FF0000/FFFFFF?text=Nike+Air+Max',
                    'https://via.placeholder.com/583x583/0000FF/FFFFFF?text=Nike+Air+Max+2'
                ]),
                'original_price' => 150.00,
                'discount_percentage' => 13,
                'material' => 'Mesh Upper, Rubber Sole',
                'care_instructions' => 'Clean with damp cloth, air dry',
                'origin' => 'Made in Vietnam',
                'colors' => json_encode([
                    ['name' => 'Black', 'color' => 'bg-gray-900'],
                    ['name' => 'White', 'color' => 'bg-white'],
                    ['name' => 'Red', 'color' => 'bg-red-600']
                ]),
                'sizes' => json_encode(['37', '38', '39', '40', '41', '42', '43', '44', '45']),
                'category' => 'kids',
                'brand' => 'Nike',
                'is_active' => 1,
                'is_featured' => 1,
                'stock_quantity' => 50,
                'is_available' => 1,
                'rating' => 0.00,
                'reviews_count' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'slug' => 'adidas-ultraboost-22',
                'description' => 'Revolutionary running shoes with Boost midsole technology.',
                'price' => 180.00,
                'sku' => 'SKU-ADIDAS-001',
                'track_quantity' => 1,
                'quantity' => 30,
                'min_quantity' => 1,
                'category_id' => 1,
                'brand_id' => 2,
                'status' => 'active',
                'featured' => 0,
                'images' => json_encode([
                    'https://via.placeholder.com/583x583/000000/FFFFFF?text=Adidas+Ultraboost',
                    'https://via.placeholder.com/583x583/333333/FFFFFF?text=Adidas+Ultraboost+2'
                ]),
                'original_price' => 200.00,
                'discount_percentage' => 10,
                'material' => 'Primeknit Upper, Boost Midsole',
                'care_instructions' => 'Machine wash cold, air dry',
                'origin' => 'Made in Germany',
                'colors' => json_encode([
                    ['name' => 'Black', 'color' => 'bg-gray-900'],
                    ['name' => 'White', 'color' => 'bg-white'],
                    ['name' => 'Blue', 'color' => 'bg-blue-600']
                ]),
                'sizes' => json_encode(['37', '38', '39', '40', '41', '42', '43', '44', '45']),
                'category' => 'men',
                'brand' => 'Adidas',
                'is_active' => 1,
                'is_featured' => 0,
                'stock_quantity' => 30,
                'is_available' => 1,
                'rating' => 0.00,
                'reviews_count' => 0,
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
            } catch (PDOException $e) {
                echo "  ⚠️ Error inserting record: " . $e->getMessage() . "\n";
            }
        }
        
        echo "  ✅ Inserted $inserted records into `$table`\n\n";
        $totalInserted += $inserted;
    }
    
    echo "🎉 Import completed!\n";
    echo "📊 Total records inserted: $totalInserted\n";
    
    // Verify data
    echo "\n🔍 Verifying imported data...\n";
    foreach (array_keys($sampleData) as $table) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM `$table`");
        $count = $stmt->fetchColumn();
        echo "  📋 `$table`: $count records\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n✅ Data import complete!\n";
echo "🌐 Now test your API endpoints!\n";

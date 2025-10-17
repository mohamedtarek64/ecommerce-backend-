<?php

echo "🔄 Creating Compatible RealProductsSeeder...\n\n";

// Read the JSON export file
$jsonFile = 'database_exports/database_export_2025-10-17_11-01-04.json';

if (!file_exists($jsonFile)) {
    echo "❌ JSON file not found: $jsonFile\n";
    exit(1);
}

$jsonData = json_decode(file_get_contents($jsonFile), true);
$productsWomen = $jsonData['products_women'] ?? [];
$productsMen = $jsonData['products_men'] ?? [];
$productsKids = $jsonData['products_kids'] ?? [];

echo "📊 Processing data:\n";
echo "   - Women: " . count($productsWomen) . " products\n";
echo "   - Men: " . count($productsMen) . " products\n";
echo "   - Kids: " . count($productsKids) . " products\n\n";

// Map data to ACTUAL localhost schema
function mapToRailwaySchema($product, $targetTable) {
    // REAL Schema for both products_women and products_kids:
    // id, name, slug, sku, description, price, original_price, old_price
    // category, subcategory, brand, image_url, images, additional_images, videos
    // stock, stock_quantity, is_active, rating, reviews_count, featured
    // sizes, colors, size, color, created_at, updated_at
    
    return [
        'name' => $product['name'],
        'slug' => $product['slug'] ?? null,
        'sku' => $product['sku'] ?? 'SKU-' . uniqid(),
        'description' => $product['description'],
        'price' => $product['price'],
        'original_price' => $product['original_price'] ?? null,
        'old_price' => $product['old_price'] ?? null,
        'category' => $product['category'] ?? ($targetTable === 'products_women' ? 'Women' : 'Kids'),
        'subcategory' => $product['subcategory'] ?? null,
        'brand' => $product['brand'] ?? 'Unknown',
        'image_url' => $product['image_url'],
        'images' => $product['images'] ?? '[]',
        'additional_images' => $product['additional_images'] ?? null,
        'videos' => $product['videos'] ?? null,
        'stock' => $product['stock'] ?? 0,
        'stock_quantity' => $product['stock_quantity'] ?? 0,
        'is_active' => $product['is_active'] ?? 1,
        'rating' => $product['rating'] ?? '0.00',
        'reviews_count' => $product['reviews_count'] ?? 0,
        'featured' => $product['featured'] ?? 0,
        'sizes' => $product['sizes'] ?? null,
        'colors' => $product['colors'] ?? null,
        'size' => $product['size'] ?? null,
        'color' => $product['color'] ?? null,
        'created_at' => $product['created_at'] ?? date('Y-m-d H:i:s'),
        'updated_at' => $product['updated_at'] ?? date('Y-m-d H:i:s'),
    ];
}

// Convert data
$mappedWomen = array_map(function($p) { return mapToRailwaySchema($p, 'products_women'); }, $productsWomen);
$mappedMen = []; // products_men table is empty (only id and timestamps)
$mappedKids = array_map(function($p) { return mapToRailwaySchema($p, 'products_kids'); }, $productsMen); // Use men data for kids

echo "✅ Data mapped successfully\n\n";

// Generate Seeder
$seederCode = '<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RealProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder contains REAL data from localhost, mapped to Railway schema.
     */
    public function run(): void
    {
        echo "🌱 Seeding Real Products Data (Compatible Schema)...\\n";

        // Products Women Data (' . count($mappedWomen) . ' products)
        $productsWomen = ' . var_export($mappedWomen, true) . ';

        // Products Kids Data (' . count($mappedKids) . ' products)
        $productsKids = ' . var_export($mappedKids, true) . ';

        // Insert products_women
        if (Schema::hasTable(\'products_women\') && count($productsWomen) > 0) {
            echo "📝 Seeding products_women...\\n";
            try {
                DB::table(\'products_women\')->insert($productsWomen);
                echo "✅ Added " . count($productsWomen) . " women products\\n";
            } catch (\Exception $e) {
                echo "❌ Error seeding products_women: " . $e->getMessage() . "\\n";
            }
        }

        // Insert products_kids
        if (Schema::hasTable(\'products_kids\') && count($productsKids) > 0) {
            echo "📝 Seeding products_kids...\\n";
            try {
                DB::table(\'products_kids\')->insert($productsKids);
                echo "✅ Added " . count($productsKids) . " kids products\\n";
            } catch (\Exception $e) {
                echo "❌ Error seeding products_kids: " . $e->getMessage() . "\\n";
            }
        }

        echo "⚠️ Skipping products_men (table only has id and timestamps)\\n";

        echo "🎉 Real products seeding completed!\\n";
        echo "📊 Summary: Women=" . count($productsWomen) . ", Kids=" . count($productsKids) . "\\n";
    }
}
';

file_put_contents('database/seeders/RealProductsSeeder.php', $seederCode);

echo "✅ Compatible RealProductsSeeder created!\n";
echo "📊 Total products: " . (count($mappedWomen) + count($mappedKids)) . "\n";
echo "   - Women: " . count($mappedWomen) . "\n";
echo "   - Kids: " . count($mappedKids) . "\n\n";
echo "🎉 Ready to push to Railway!\n";

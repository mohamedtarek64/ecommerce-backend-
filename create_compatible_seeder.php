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

// Map data to match Railway schema
function mapToRailwaySchema($product, $targetTable) {
    if ($targetTable === 'products_women') {
        // Schema: name, price, description, image_url, category, brand, size, color, material, is_active, stock_quantity, sku, weight, dimensions, care_instructions, tags, meta_title, meta_description, slug, featured, discount_percentage, original_price, timestamps
        
        // Handle images - use additional_images if available, otherwise use images array
        $imagesData = $product['additional_images'] ?? $product['images'] ?? '[]';
        
        // Handle colors - keep as JSON string
        $colorsData = $product['colors'] ?? null;
        
        // Handle sizes - keep as JSON string
        $sizesData = $product['sizes'] ?? null;
        
        return [
            'name' => $product['name'],
            'price' => $product['price'],
            'description' => $product['description'],
            'image_url' => $product['image_url'],
            'category' => $product['category'] ?? 'women',
            'brand' => $product['brand'] ?? 'Unknown',
            'size' => $sizesData, // JSON array of sizes
            'color' => $colorsData, // JSON array of colors
            'sku' => $product['sku'] ?? 'SKU-' . uniqid(),
            'stock_quantity' => $product['stock_quantity'] ?? 0,
            'is_active' => $product['is_active'] ?? 1,
            'featured' => $product['featured'] ?? 0,
            'discount_percentage' => isset($product['original_price']) && $product['original_price'] > $product['price'] 
                ? round((($product['original_price'] - $product['price']) / $product['original_price']) * 100, 2)
                : $product['discount_percentage'] ?? null,
            'original_price' => $product['original_price'] ?? null,
            'slug' => $product['slug'] ?? null,
            'dimensions' => $product['dimensions'] ?? null,
            'weight' => $product['weight'] ?? null,
            'tags' => $product['tags'] ?? null,
            'meta_title' => $product['meta_title'] ?? null,
            'meta_description' => $product['meta_description'] ?? null,
            'care_instructions' => $product['care_instructions'] ?? null,
            'material' => $product['material'] ?? null,
            'created_at' => $product['created_at'] ?? date('Y-m-d H:i:s'),
            'updated_at' => $product['updated_at'] ?? date('Y-m-d H:i:s'),
        ];
    } elseif ($targetTable === 'products_kids') {
        // Schema: id, name, description, price, original_price, image_url, sku, stock_quantity, category_id, brand_id, is_active, is_featured, timestamps
        return [
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => $product['price'],
            'original_price' => $product['original_price'] ?? null,
            'image_url' => $product['image_url'],
            'sku' => $product['sku'] ?? 'SKU-' . uniqid(),
            'stock_quantity' => $product['stock_quantity'] ?? 0,
            'category_id' => 3, // Kids category
            'brand_id' => null,
            'is_active' => $product['is_active'] ?? 1,
            'is_featured' => $product['featured'] ?? 0,
            'created_at' => $product['created_at'] ?? date('Y-m-d H:i:s'),
            'updated_at' => $product['updated_at'] ?? date('Y-m-d H:i:s'),
        ];
    }
    
    return [];
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

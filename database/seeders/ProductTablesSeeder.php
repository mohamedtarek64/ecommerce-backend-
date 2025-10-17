<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "🌱 Seeding Products Tables from main products table...\n";

        // Get all products from main products table
        $allProducts = DB::table('products')->get();

        if ($allProducts->isEmpty()) {
            echo "⚠️ No products found in main products table. Skipping...\n";
            return;
        }

        echo "📊 Found " . count($allProducts) . " products in main table\n";

        // Prepare data for each category table
        $kidsProducts = [];
        $menProducts = [];
        $womenProducts = [];

        foreach ($allProducts as $product) {
            $category = strtolower($product->category ?? '');

            // Decode images to get first image
            $images = json_decode($product->images, true);
            $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;

            if ($category === 'kids') {
                // products_kids schema: id, name, description, price, original_price, image_url, sku, stock_quantity, category_id, brand_id, is_active, is_featured, timestamps
                $kidsProducts[] = [
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'original_price' => $product->original_price,
                    'image_url' => $firstImage,
                    'sku' => $product->sku,
                    'stock_quantity' => $product->stock_quantity ?? 0,
                    'category_id' => $product->category_id,
                    'brand_id' => null, // brand_id might not exist in main table
                    'is_active' => $product->is_active ?? 1,
                    'is_featured' => $product->is_featured ?? 0,
                    'created_at' => $product->created_at ?? now(),
                    'updated_at' => $product->updated_at ?? now()
                ];
            } elseif ($category === 'women') {
                // products_women schema: name, price, description, image_url, category, brand, size, color, material, is_active, stock_quantity, sku, weight, dimensions, care_instructions, tags, meta_title, meta_description, slug, featured, discount_percentage, original_price, timestamps
                $womenProducts[] = [
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'original_price' => $product->original_price,
                    'discount_percentage' => $product->discount_percentage,
                    'image_url' => $firstImage,
                    'sku' => $product->sku,
                    'brand' => $product->brand ?? 'Unknown',
                    'category' => $category,
                    'material' => $product->material,
                    'care_instructions' => $product->care_instructions,
                    'is_active' => $product->is_active ?? 1,
                    'featured' => $product->is_featured ?? 0,
                    'stock_quantity' => $product->stock_quantity ?? 0,
                    'slug' => $product->slug ?? null,
                    'created_at' => $product->created_at ?? now(),
                    'updated_at' => $product->updated_at ?? now()
                ];
            }
            // Note: products_men table only has id and timestamps, so we skip it
        }

        // products_men table only has id and timestamps, so we skip it
        $menProducts = [];

        // Insert data into products_kids
        if (Schema::hasTable('products_kids') && count($kidsProducts) > 0) {
            echo "📝 Seeding products_kids...\n";
            try {
                DB::table('products_kids')->insert($kidsProducts);
                echo "✅ Added " . count($kidsProducts) . " kids products\n";
            } catch (\Exception $e) {
                echo "❌ Error seeding products_kids: " . $e->getMessage() . "\n";
            }
        } else {
            echo "⚠️ Skipping products_kids (no data for kids category)\n";
        }

        // Insert data into products_men
        if (Schema::hasTable('products_men') && count($menProducts) > 0) {
            echo "📝 Seeding products_men...\n";
            try {
                DB::table('products_men')->insert($menProducts);
                echo "✅ Added " . count($menProducts) . " men products\n";
            } catch (\Exception $e) {
                echo "❌ Error seeding products_men: " . $e->getMessage() . "\n";
            }
        } else {
            echo "⚠️ Skipping products_men (table is empty or no data available)\n";
        }

        // Insert data into products_women
        if (Schema::hasTable('products_women') && count($womenProducts) > 0) {
            echo "📝 Seeding products_women...\n";
            try {
                DB::table('products_women')->insert($womenProducts);
                echo "✅ Added " . count($womenProducts) . " women products\n";
            } catch (\Exception $e) {
                echo "❌ Error seeding products_women: " . $e->getMessage() . "\n";
            }
        } else {
            echo "⚠️ Skipping products_women (no data for women category)\n";
        }

        echo "🎉 Product tables seeding completed!\n";
        echo "📊 Summary: Kids=" . count($kidsProducts) . ", Men=" . count($menProducts) . ", Women=" . count($womenProducts) . "\n";
    }
}



<?php

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
        echo "🌱 Seeding Real Products Data (Compatible Schema)...\n";
        
        // Products Women Data (6 products)
        $productsWomen = array (
  0 => 
  array (
    'name' => 'Stabil 16 Indoor Shoes',
    'price' => '85.00',
    'description' => 'Built for indoor training sessions, the Stabil 16 Indoor Shoes provide excellent grip and stability on gym floors. Available in Off White and Black White colorways.',
    'image_url' => 'https://assets.adidas.com/images/w_1880,f_auto,q_auto/fa49d42677a74752808affbff9994b00_9366/JP9764_HM3_hover.jpg',
    'category' => 'Women',
    'brand' => 'Adidas',
    'sku' => '12',
    'stock_quantity' => 1200,
    'is_active' => 1,
    'featured' => 0,
    'discount_percentage' => 15.0,
    'original_price' => '100.00',
    'slug' => 'stabil-16-indoor-shoes-off-white',
    'created_at' => '2025-10-13 20:20:09',
    'updated_at' => '2025-10-16 15:38:47',
  ),
  1 => 
  array (
    'name' => 'WX608V5',
    'price' => '85.00',
    'description' => 'New Balance WX608V5 training shoes - designed for comfort and performance during your workout sessions.',
    'image_url' => 'https://nb.scene7.com/is/image/NB/wx608wb5_nb_02_i?$pdpflexf2$&qlt=80&fmt=webp&wid=440&hei=440',
    'category' => 'training',
    'brand' => 'New Balance',
    'sku' => 'WX608WB5',
    'stock_quantity' => 150,
    'is_active' => 1,
    'featured' => 1,
    'discount_percentage' => NULL,
    'original_price' => NULL,
    'slug' => NULL,
    'created_at' => '2025-10-15 16:32:19',
    'updated_at' => '2025-10-16 07:57:13',
  ),
  2 => 
  array (
    'name' => 'FuelCell Rebel v5',
    'price' => '140.00',
    'description' => 'New Balance FuelCell Rebel v5 running shoes - lightweight and responsive for fast-paced runs.',
    'image_url' => 'https://nb.scene7.com/is/image/NB/wfcxli5_nb_02_i?$pdpflexf2$&qlt=80&fmt=webp&wid=440&hei=440',
    'category' => 'running',
    'brand' => 'New Balance',
    'sku' => 'SKU-68f2954dca3a8',
    'stock_quantity' => 100,
    'is_active' => 1,
    'featured' => 1,
    'discount_percentage' => NULL,
    'original_price' => NULL,
    'slug' => NULL,
    'created_at' => '2025-10-15 19:59:58',
    'updated_at' => '2025-10-15 19:59:58',
  ),
  3 => 
  array (
    'name' => 'Chuck Taylor All Star Lift Platform Low Top Limited Time Colours',
    'price' => '75.00',
    'description' => 'Elevate your style with the Chuck Taylor All Star Lift Platform in Sugar Berry. This iconic sneaker features a platform sole for added height and a vibrant pink colorway perfect for making a statement.',
    'image_url' => 'https://converse.ca/cdn/shop/files/A11875C_A11875C_A_107X1_640d982f-c1ff-4dbe-9750-fce47c269765.jpg?v=1754070984&width=1200',
    'category' => 'lifestyle',
    'brand' => 'Converse',
    'sku' => 'CONV-A11875C',
    'stock_quantity' => 50,
    'is_active' => 1,
    'featured' => 1,
    'discount_percentage' => 11.76,
    'original_price' => '85.00',
    'slug' => 'chuck-taylor-all-star-lift-platform-sugar-berry',
    'created_at' => '2025-10-15 20:01:19',
    'updated_at' => '2025-10-15 20:01:19',
  ),
  4 => 
  array (
    'name' => '530',
    'price' => '99.99',
    'description' => 'The New Balance 530 combines retro style with modern comfort. Featuring a sleek white design with silver metallic accents, premium materials, and ABZORB cushioning technology for all-day comfort. Perfect for lifestyle and casual wear.',
    'image_url' => 'https://nb.scene7.com/is/image/NB/u530hfw_nb_02_i?$pdpflexf2$&qlt=80&fmt=webp&wid=440&hei=440',
    'category' => 'lifestyle',
    'brand' => 'New Balance',
    'sku' => 'U530HFW',
    'stock_quantity' => 50,
    'is_active' => 1,
    'featured' => 0,
    'discount_percentage' => NULL,
    'original_price' => NULL,
    'slug' => NULL,
    'created_at' => '2025-10-15 21:53:44',
    'updated_at' => '2025-10-15 21:53:44',
  ),
  5 => 
  array (
    'name' => 'Gazelle Indoor Shoes',
    'price' => '95.00',
    'description' => 'Adidas Gazelle Indoor Shoes for women - classic indoor sports design with Sand Strata Preloved Brown Gum colorway.',
    'image_url' => 'https://assets.adidas.com/images/w_1880,f_auto,q_auto/1877a5d318d14c33a6a0a5f87df683e2_9366/JS1418_01_00_standard.jpg',
    'category' => 'indoor',
    'brand' => 'Adidas',
    'sku' => 'SKU-68f2954dca3bd',
    'stock_quantity' => 100,
    'is_active' => 1,
    'featured' => 1,
    'discount_percentage' => NULL,
    'original_price' => NULL,
    'slug' => NULL,
    'created_at' => '2025-10-16 09:49:24',
    'updated_at' => '2025-10-16 09:49:24',
  ),
);
        
        // Products Kids Data (6 products)
        $productsKids = array (
  0 => 
  array (
    'name' => 'Made in USA 990v6',
    'description' => 'The New Balance 990v6 is a premium lifestyle sneaker that combines classic design with modern comfort. Made in USA with superior craftsmanship, featuring grey and white colorway. Built with premium suede and mesh upper, ENCAP midsole technology for superior cushioning and support.',
    'price' => '185.00',
    'original_price' => NULL,
    'image_url' => 'https://nb.scene7.com/is/image/NB/m990gl6_nb_05_i?$pdpflexf22x$&qlt=80&fmt=webp&wid=880&hei=880',
    'sku' => 'SKU-68f2954dca3ca',
    'stock_quantity' => 150,
    'category_id' => 3,
    'brand_id' => NULL,
    'is_active' => 1,
    'is_featured' => 1,
    'created_at' => '2025-10-14 20:25:53',
    'updated_at' => '2025-10-16 07:57:13',
  ),
  1 => 
  array (
    'name' => 'OZMILLEN Shoes',
    'description' => 'Step into style with OZMILLEN Shoes. These lifestyle sneakers feature a sleek Alumina colorway that pairs perfectly with any casual outfit. Built with premium materials and modern design aesthetics.',
    'price' => '120.00',
    'original_price' => '140.00',
    'image_url' => 'https:\\/\\/assets.adidas.com\\/images\\/w_1880,f_auto,q_auto\\/0184b95a5db14b139b8d183cd2756108_9366\\/IF9597_01_00_standard.jpg',
    'sku' => 'ADI-IF9597-ALU',
    'stock_quantity' => 75,
    'category_id' => 3,
    'brand_id' => NULL,
    'is_active' => 1,
    'is_featured' => 0,
    'created_at' => '2025-10-13 19:32:00',
    'updated_at' => '2025-10-13 19:37:36',
  ),
  2 => 
  array (
    'name' => 'Converse Chuck 70 Low Top',
    'description' => 'The Chuck 70 is built off the original 1970s design, with premium materials and extraordinary craftsmanship. This low top sneaker features a durable canvas upper, vintage license plate on the heel, and a cushioned footbed for all-day comfort.',
    'price' => '99.99',
    'original_price' => NULL,
    'image_url' => 'https://converse.ca/cdn/shop/files/162058C_A10358C_L_08X1_1946c30a-ab70-421d-9dd4-159f5a8ccb4c.jpg?v=1746814272&width=500',
    'sku' => '162058C',
    'stock_quantity' => 50,
    'category_id' => 3,
    'brand_id' => NULL,
    'is_active' => 1,
    'is_featured' => 0,
    'created_at' => '2025-10-15 20:53:30',
    'updated_at' => '2025-10-15 20:56:43',
  ),
  3 => 
  array (
    'name' => 'Converse Weapon Mid Top',
    'description' => 'The Weapon Mid Top brings back the classic basketball silhouette with modern comfort. Featuring a durable canvas upper, padded collar for ankle support, and the iconic Converse star logo. Perfect for both court and street style.',
    'price' => '89.99',
    'original_price' => NULL,
    'image_url' => 'https://converse.ca/cdn/shop/files/A10597C_A10597C_A_107X1_137f0835-0ab7-44c3-a8dc-ad9308219aa5.jpg?v=1745373807&width=1200',
    'sku' => 'A10597C',
    'stock_quantity' => 45,
    'category_id' => 3,
    'brand_id' => NULL,
    'is_active' => 1,
    'is_featured' => 0,
    'created_at' => '2025-10-15 21:38:48',
    'updated_at' => '2025-10-15 21:38:48',
  ),
  4 => 
  array (
    'name' => 'Samba OG Shoes',
    'description' => 'The Samba OG Shoes brings classic style to modern streetwear. Featuring a premium leather upper with iconic 3-Stripes, these shoes offer comfort and style.',
    'price' => '100.00',
    'original_price' => '120.00',
    'image_url' => 'https://assets.adidas.com/images/w_1880,f_auto,q_auto/32f939960439490da70e8fc81e3f5243_9366/IH4882_01_standard.jpg',
    'sku' => 'ADIDAS-SAMBA-BW-001',
    'stock_quantity' => 50,
    'category_id' => 3,
    'brand_id' => NULL,
    'is_active' => 1,
    'is_featured' => 1,
    'created_at' => '2025-10-13 17:18:51',
    'updated_at' => '2025-10-13 17:18:51',
  ),
  5 => 
  array (
    'name' => 'Campus 00s Shoes',
    'description' => 'The Campus 00s Shoes deliver a fresh take on a classic design. With premium materials and contemporary styling, these shoes offer both comfort and style for everyday wear.',
    'price' => '85.00',
    'original_price' => NULL,
    'image_url' => 'https://assets.adidas.com/images/w_1880,f_auto,q_auto/723e321ebd8b48bdbbf6b00135b9ed7b_9366/JI3163_01_00_standard.jpg',
    'sku' => 'SKU-68f2954dca3da',
    'stock_quantity' => 50,
    'category_id' => 3,
    'brand_id' => NULL,
    'is_active' => 1,
    'is_featured' => 0,
    'created_at' => '2025-10-16 10:18:11',
    'updated_at' => '2025-10-16 13:12:01',
  ),
);
        
        // Insert products_women
        if (Schema::hasTable('products_women') && count($productsWomen) > 0) {
            echo "📝 Seeding products_women...\n";
            try {
                DB::table('products_women')->insert($productsWomen);
                echo "✅ Added " . count($productsWomen) . " women products\n";
            } catch (\Exception $e) {
                echo "❌ Error seeding products_women: " . $e->getMessage() . "\n";
            }
        }
        
        // Insert products_kids
        if (Schema::hasTable('products_kids') && count($productsKids) > 0) {
            echo "📝 Seeding products_kids...\n";
            try {
                DB::table('products_kids')->insert($productsKids);
                echo "✅ Added " . count($productsKids) . " kids products\n";
            } catch (\Exception $e) {
                echo "❌ Error seeding products_kids: " . $e->getMessage() . "\n";
            }
        }
        
        echo "⚠️ Skipping products_men (table only has id and timestamps)\n";
        
        echo "🎉 Real products seeding completed!\n";
        echo "📊 Summary: Women=" . count($productsWomen) . ", Kids=" . count($productsKids) . "\n";
    }
}

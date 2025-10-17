<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🚀 Starting Database Export...\n\n";

try {
    // Create exports directory
    $exportDir = 'database_exports';
    if (!File::exists($exportDir)) {
        File::makeDirectory($exportDir, 0755, true);
    }

    $timestamp = date('Y-m-d_H-i-s');
    $exportFile = "{$exportDir}/database_export_{$timestamp}.json";

    $exportData = [];

    // Export Users
    echo "📊 Exporting Users...\n";
    $users = DB::table('users')->get();
    $exportData['users'] = $users->toArray();
    echo "✅ Exported " . $users->count() . " users\n";

    // Export Categories
    echo "📊 Exporting Categories...\n";
    $categories = DB::table('categories')->get();
    $exportData['categories'] = $categories->toArray();
    echo "✅ Exported " . $categories->count() . " categories\n";

    // Export Brands
    echo "📊 Exporting Brands...\n";
    $brands = DB::table('brands')->get();
    $exportData['brands'] = $brands->toArray();
    echo "✅ Exported " . $brands->count() . " brands\n";

    // Export Products Women
    echo "📊 Exporting Products Women...\n";
    $productsWomen = DB::table('products_women')->get();
    $exportData['products_women'] = $productsWomen->toArray();
    echo "✅ Exported " . $productsWomen->count() . " women products\n";

    // Export Products Men
    echo "📊 Exporting Products Men...\n";
    $productsMen = DB::table('products_men')->get();
    $exportData['products_men'] = $productsMen->toArray();
    echo "✅ Exported " . $productsMen->count() . " men products\n";

    // Export Products Kids
    echo "📊 Exporting Products Kids...\n";
    $productsKids = DB::table('products_kids')->get();
    $exportData['products_kids'] = $productsKids->toArray();
    echo "✅ Exported " . $productsKids->count() . " kids products\n";

    // Export Cart Items
    echo "📊 Exporting Cart Items...\n";
    $cartItems = DB::table('cart_items')->get();
    $exportData['cart_items'] = $cartItems->toArray();
    echo "✅ Exported " . $cartItems->count() . " cart items\n";

    // Export Orders
    echo "📊 Exporting Orders...\n";
    $orders = DB::table('orders')->get();
    $exportData['orders'] = $orders->toArray();
    echo "✅ Exported " . $orders->count() . " orders\n";

    // Export Order Items
    echo "📊 Exporting Order Items...\n";
    $orderItems = DB::table('order_items')->get();
    $exportData['order_items'] = $orderItems->toArray();
    echo "✅ Exported " . $orderItems->count() . " order items\n";

    // Export Wishlist Items (wishlist table doesn't exist, only wishlist_items)
    echo "📊 Exporting Wishlist Items...\n";
    $wishlistItems = DB::table('wishlist_items')->get();
    $exportData['wishlist_items'] = $wishlistItems->toArray();
    echo "✅ Exported " . $wishlistItems->count() . " wishlist items\n";

    // Export Images
    echo "📊 Exporting Images...\n";
    $images = DB::table('images')->get();
    $exportData['images'] = $images->toArray();
    echo "✅ Exported " . $images->count() . " images\n";

    // Export Discount Codes
    echo "📊 Exporting Discount Codes...\n";
    $discountCodes = DB::table('discount_codes')->get();
    $exportData['discount_codes'] = $discountCodes->toArray();
    echo "✅ Exported " . $discountCodes->count() . " discount codes\n";

    // Export Invoices
    echo "📊 Exporting Invoices...\n";
    $invoices = DB::table('invoices')->get();
    $exportData['invoices'] = $invoices->toArray();
    echo "✅ Exported " . $invoices->count() . " invoices\n";

    // Export Invoice Items
    echo "📊 Exporting Invoice Items...\n";
    $invoiceItems = DB::table('invoice_items')->get();
    $exportData['invoice_items'] = $invoiceItems->toArray();
    echo "✅ Exported " . $invoiceItems->count() . " invoice items\n";

    // Export Notifications
    echo "📊 Exporting Notifications...\n";
    $notifications = DB::table('notifications')->get();
    $exportData['notifications'] = $notifications->toArray();
    echo "✅ Exported " . $notifications->count() . " notifications\n";

    // Export Product Colors
    echo "📊 Exporting Product Colors...\n";
    $productColors = DB::table('product_colors')->get();
    $exportData['product_colors'] = $productColors->toArray();
    echo "✅ Exported " . $productColors->count() . " product colors\n";

    // Export Product Sizes
    echo "📊 Exporting Product Sizes...\n";
    $productSizes = DB::table('product_sizes')->get();
    $exportData['product_sizes'] = $productSizes->toArray();
    echo "✅ Exported " . $productSizes->count() . " product sizes\n";

    // Export Personal Access Tokens (for API authentication)
    echo "📊 Exporting Personal Access Tokens...\n";
    $personalAccessTokens = DB::table('personal_access_tokens')->get();
    $exportData['personal_access_tokens'] = $personalAccessTokens->toArray();
    echo "✅ Exported " . $personalAccessTokens->count() . " personal access tokens\n";

    // Add export metadata
    $exportData['export_metadata'] = [
        'exported_at' => now()->toDateTimeString(),
        'exported_by' => 'Database Export Script',
        'total_tables' => count($exportData) - 1, // -1 for metadata
        'total_records' => array_sum(array_map('count', array_filter($exportData, function($key) {
            return $key !== 'export_metadata';
        }, ARRAY_FILTER_USE_KEY)))
    ];

    // Save to JSON file
    echo "\n💾 Saving export to file...\n";
    File::put($exportFile, json_encode($exportData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "✅ Export completed successfully!\n";
    echo "📁 Export file: {$exportFile}\n";
    echo "📊 Total records exported: " . $exportData['export_metadata']['total_records'] . "\n";
    echo "📋 Total tables exported: " . $exportData['export_metadata']['total_tables'] . "\n\n";

    // Create summary file
    $summaryFile = "{$exportDir}/export_summary_{$timestamp}.txt";
    $summary = "DATABASE EXPORT SUMMARY\n";
    $summary .= "=====================\n\n";
    $summary .= "Export Date: " . $exportData['export_metadata']['exported_at'] . "\n";
    $summary .= "Total Tables: " . $exportData['export_metadata']['total_tables'] . "\n";
    $summary .= "Total Records: " . $exportData['export_metadata']['total_records'] . "\n\n";

    $summary .= "TABLE BREAKDOWN:\n";
    $summary .= "===============\n";
    foreach ($exportData as $table => $data) {
        if ($table !== 'export_metadata') {
            $count = is_array($data) ? count($data) : 0;
            $summary .= sprintf("%-20s: %d records\n", $table, $count);
        }
    }

    File::put($summaryFile, $summary);
    echo "📋 Summary file: {$summaryFile}\n";

} catch (Exception $e) {
    echo "❌ Export failed: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n🎉 Database export completed successfully!\n";

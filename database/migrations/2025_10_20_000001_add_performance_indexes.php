<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add performance indexes to products tables (only if columns exist)
        if (Schema::hasColumn('products_women', 'is_active')) {
            Schema::table('products_women', function (Blueprint $table) {
                if (Schema::hasColumn('products_women', 'created_at')) {
                    $table->index(['is_active', 'created_at'], 'idx_women_active_created');
                }
                if (Schema::hasColumn('products_women', 'category')) {
                    $table->index(['category', 'is_active'], 'idx_women_category_active');
                }
                if (Schema::hasColumn('products_women', 'price')) {
                    $table->index(['price'], 'idx_women_price');
                }
                if (Schema::hasColumn('products_women', 'brand')) {
                    $table->index(['brand'], 'idx_women_brand');
                }
            });
        }

        if (Schema::hasColumn('products_men', 'is_active')) {
            Schema::table('products_men', function (Blueprint $table) {
                if (Schema::hasColumn('products_men', 'created_at')) {
                    $table->index(['is_active', 'created_at'], 'idx_men_active_created');
                }
                if (Schema::hasColumn('products_men', 'category')) {
                    $table->index(['category', 'is_active'], 'idx_men_category_active');
                }
                if (Schema::hasColumn('products_men', 'price')) {
                    $table->index(['price'], 'idx_men_price');
                }
                if (Schema::hasColumn('products_men', 'brand')) {
                    $table->index(['brand'], 'idx_men_brand');
                }
            });
        }

        if (Schema::hasColumn('products_kids', 'is_active')) {
            Schema::table('products_kids', function (Blueprint $table) {
                if (Schema::hasColumn('products_kids', 'created_at')) {
                    $table->index(['is_active', 'created_at'], 'idx_kids_active_created');
                }
                if (Schema::hasColumn('products_kids', 'category')) {
                    $table->index(['category', 'is_active'], 'idx_kids_category_active');
                }
                if (Schema::hasColumn('products_kids', 'price')) {
                    $table->index(['price'], 'idx_kids_price');
                }
                if (Schema::hasColumn('products_kids', 'brand')) {
                    $table->index(['brand'], 'idx_kids_brand');
                }
            });
        }

        // Add indexes to cart table (only if columns exist)
        if (Schema::hasTable('cart_items')) {
            Schema::table('cart_items', function (Blueprint $table) {
                if (Schema::hasColumn('cart_items', 'user_id')) {
                    $table->index(['user_id', 'created_at'], 'idx_cart_user_created');
                }
                if (Schema::hasColumn('cart_items', 'product_id')) {
                    $table->index(['product_id'], 'idx_cart_product');
                }
            });
        }

        // Add indexes to orders table (only if columns exist)
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (Schema::hasColumn('orders', 'user_id')) {
                    $table->index(['user_id', 'created_at'], 'idx_orders_user_created');
                }
                if (Schema::hasColumn('orders', 'status')) {
                    $table->index(['status'], 'idx_orders_status');
                }
                if (Schema::hasColumn('orders', 'order_number')) {
                    $table->index(['order_number'], 'idx_orders_number');
                }
            });
        }

        // Add indexes to order_items table (only if columns exist)
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                if (Schema::hasColumn('order_items', 'order_id')) {
                    $table->index(['order_id'], 'idx_order_items_order');
                }
                if (Schema::hasColumn('order_items', 'product_id')) {
                    $table->index(['product_id'], 'idx_order_items_product');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop performance indexes
        Schema::table('products_women', function (Blueprint $table) {
            $table->dropIndex('idx_women_active_created');
            $table->dropIndex('idx_women_category_active');
            $table->dropIndex('idx_women_price');
            $table->dropIndex('idx_women_brand');
        });

        Schema::table('products_men', function (Blueprint $table) {
            $table->dropIndex('idx_men_active_created');
            $table->dropIndex('idx_men_category_active');
            $table->dropIndex('idx_men_price');
            $table->dropIndex('idx_men_brand');
        });

        Schema::table('products_kids', function (Blueprint $table) {
            $table->dropIndex('idx_kids_active_created');
            $table->dropIndex('idx_kids_category_active');
            $table->dropIndex('idx_kids_price');
            $table->dropIndex('idx_kids_brand');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropIndex('idx_cart_user_created');
            $table->dropIndex('idx_cart_product');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_orders_user_created');
            $table->dropIndex('idx_orders_status');
            $table->dropIndex('idx_orders_number');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex('idx_order_items_order');
            $table->dropIndex('idx_order_items_product');
        });
    }
};

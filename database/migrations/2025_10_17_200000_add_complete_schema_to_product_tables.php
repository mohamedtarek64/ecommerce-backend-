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
        // Add missing columns to products_women
        Schema::table('products_women', function (Blueprint $table) {
            if (!Schema::hasColumn('products_women', 'images')) {
                $table->text('images')->nullable();
            }
            if (!Schema::hasColumn('products_women', 'additional_images')) {
                $table->text('additional_images')->nullable();
            }
            if (!Schema::hasColumn('products_women', 'videos')) {
                $table->text('videos')->nullable();
            }
            if (!Schema::hasColumn('products_women', 'subcategory')) {
                $table->string('subcategory')->nullable();
            }
            if (!Schema::hasColumn('products_women', 'old_price')) {
                $table->decimal('old_price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('products_women', 'stock')) {
                $table->integer('stock')->default(0);
            }
            if (!Schema::hasColumn('products_women', 'rating')) {
                $table->decimal('rating', 3, 2)->default(0);
            }
            if (!Schema::hasColumn('products_women', 'reviews_count')) {
                $table->integer('reviews_count')->default(0);
            }
            if (!Schema::hasColumn('products_women', 'sizes')) {
                $table->text('sizes')->nullable();
            }
            if (!Schema::hasColumn('products_women', 'colors')) {
                $table->text('colors')->nullable();
            }
        });

        // Add missing columns to products_men
        Schema::table('products_men', function (Blueprint $table) {
            if (!Schema::hasColumn('products_men', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('products_men', 'slug')) {
                $table->string('slug')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'sku')) {
                $table->string('sku')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'price')) {
                $table->decimal('price', 10, 2);
            }
            if (!Schema::hasColumn('products_men', 'original_price')) {
                $table->decimal('original_price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('products_men', 'old_price')) {
                $table->decimal('old_price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('products_men', 'category')) {
                $table->string('category')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'subcategory')) {
                $table->string('subcategory')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'brand')) {
                $table->string('brand')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'image_url')) {
                $table->string('image_url')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'images')) {
                $table->text('images')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'additional_images')) {
                $table->text('additional_images')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'videos')) {
                $table->text('videos')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'stock')) {
                $table->integer('stock')->default(0);
            }
            if (!Schema::hasColumn('products_men', 'stock_quantity')) {
                $table->integer('stock_quantity')->default(0);
            }
            if (!Schema::hasColumn('products_men', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
            if (!Schema::hasColumn('products_men', 'rating')) {
                $table->decimal('rating', 3, 2)->default(0);
            }
            if (!Schema::hasColumn('products_men', 'reviews_count')) {
                $table->integer('reviews_count')->default(0);
            }
            if (!Schema::hasColumn('products_men', 'featured')) {
                $table->boolean('featured')->default(false);
            }
            if (!Schema::hasColumn('products_men', 'sizes')) {
                $table->text('sizes')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'colors')) {
                $table->text('colors')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'size')) {
                $table->string('size')->nullable();
            }
            if (!Schema::hasColumn('products_men', 'color')) {
                $table->string('color')->nullable();
            }
        });

        // Add missing columns to products_kids
        Schema::table('products_kids', function (Blueprint $table) {
            if (!Schema::hasColumn('products_kids', 'slug')) {
                $table->string('slug')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'images')) {
                $table->text('images')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'additional_images')) {
                $table->text('additional_images')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'videos')) {
                $table->text('videos')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'old_price')) {
                $table->decimal('old_price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'category')) {
                $table->string('category')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'subcategory')) {
                $table->string('subcategory')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'brand')) {
                $table->string('brand')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'stock')) {
                $table->integer('stock')->default(0);
            }
            if (!Schema::hasColumn('products_kids', 'rating')) {
                $table->decimal('rating', 3, 2)->default(0);
            }
            if (!Schema::hasColumn('products_kids', 'reviews_count')) {
                $table->integer('reviews_count')->default(0);
            }
            if (!Schema::hasColumn('products_kids', 'sizes')) {
                $table->text('sizes')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'colors')) {
                $table->text('colors')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'size')) {
                $table->string('size')->nullable();
            }
            if (!Schema::hasColumn('products_kids', 'color')) {
                $table->string('color')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products_women', function (Blueprint $table) {
            $table->dropColumn(['images', 'additional_images', 'videos', 'subcategory', 'old_price', 'stock', 'rating', 'reviews_count', 'sizes', 'colors']);
        });

        Schema::table('products_men', function (Blueprint $table) {
            $table->dropColumn(['name', 'slug', 'sku', 'description', 'price', 'original_price', 'old_price', 'category', 'subcategory', 'brand', 'image_url', 'images', 'additional_images', 'videos', 'stock', 'stock_quantity', 'is_active', 'rating', 'reviews_count', 'featured', 'sizes', 'colors', 'size', 'color']);
        });

        Schema::table('products_kids', function (Blueprint $table) {
            $table->dropColumn(['slug', 'images', 'additional_images', 'videos', 'old_price', 'category', 'subcategory', 'brand', 'stock', 'rating', 'reviews_count', 'sizes', 'colors', 'size', 'color']);
        });
    }
};


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
        $tables = ['products_women', 'products_men', 'products_kids'];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    // Add slug column if not exists
                    if (!Schema::hasColumn($table->getTable(), 'slug')) {
                        $table->string('slug')->unique()->nullable();
                    }

                    // Add original_price column if not exists
                    if (!Schema::hasColumn($table->getTable(), 'original_price')) {
                        $table->decimal('original_price', 10, 2)->nullable();
                    }

                    // Add subcategory column if not exists
                    if (!Schema::hasColumn($table->getTable(), 'subcategory')) {
                        $table->string('subcategory')->nullable();
                    }

                    // Add stock_quantity column if not exists
                    if (!Schema::hasColumn($table->getTable(), 'stock_quantity')) {
                        $table->integer('stock_quantity')->default(0);
                    }

                    // Add rating column if not exists
                    if (!Schema::hasColumn($table->getTable(), 'rating')) {
                        $table->decimal('rating', 3, 2)->default(0);
                    }

                    // Add reviews_count column if not exists
                    if (!Schema::hasColumn($table->getTable(), 'reviews_count')) {
                        $table->integer('reviews_count')->default(0);
                    }

                    // Add images column if not exists
                    if (!Schema::hasColumn($table->getTable(), 'images')) {
                        $table->json('images')->nullable();
                    }

                    // Add additional_images column if not exists
                    if (!Schema::hasColumn($table->getTable(), 'additional_images')) {
                        $table->json('additional_images')->nullable();
                    }

                    // Add videos column if not exists
                    if (!Schema::hasColumn($table->getTable(), 'videos')) {
                        $table->json('videos')->nullable();
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['products_women', 'products_men', 'products_kids'];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    $columns = [
                        'slug',
                        'original_price',
                        'subcategory',
                        'stock_quantity',
                        'rating',
                        'reviews_count',
                        'images',
                        'additional_images',
                        'videos'
                    ];

                    foreach ($columns as $column) {
                        if (Schema::hasColumn($table->getTable(), $column)) {
                            $table->dropColumn($column);
                        }
                    }
                });
            }
        }
    }
};

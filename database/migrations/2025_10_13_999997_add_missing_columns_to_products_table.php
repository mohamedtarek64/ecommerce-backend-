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
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                // Add additional_images column if not exists
                if (!Schema::hasColumn('products', 'additional_images')) {
                    $table->json('additional_images')->nullable();
                }

                // Add videos column if not exists
                if (!Schema::hasColumn('products', 'videos')) {
                    $table->json('videos')->nullable();
                }

                // Add rating column if not exists
                if (!Schema::hasColumn('products', 'rating')) {
                    $table->decimal('rating', 3, 2)->default(0);
                }

                // Add reviews_count column if not exists
                if (!Schema::hasColumn('products', 'reviews_count')) {
                    $table->integer('reviews_count')->default(0);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                $columns = ['additional_images', 'videos', 'rating', 'reviews_count'];

                foreach ($columns as $column) {
                    if (Schema::hasColumn('products', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};

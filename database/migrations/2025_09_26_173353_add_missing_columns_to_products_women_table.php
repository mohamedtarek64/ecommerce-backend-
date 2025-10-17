<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_women', function (Blueprint $table) {
            if (!Schema::hasColumn('products_women', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
            if (!Schema::hasColumn('products_women', 'stock_quantity')) {
                $table->integer('stock_quantity')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_women', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'stock_quantity']);
        });
    }
};

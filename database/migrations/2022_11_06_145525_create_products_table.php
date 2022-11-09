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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->index();
            $table->foreignId('brand_id')->index()->nullable();
            $table->string('title')->index();
            $table->string('slug');
            $table->string('barcode')->nullable();
            $table->integer('sku_no')->nullable();
            $table->integer('purchase_rate');
            $table->integer('sale_rate');
            $table->integer('stock')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};

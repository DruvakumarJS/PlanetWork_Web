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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_type');
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('tax_preference')->nullable();
            $table->string('sku')->nullable();
            $table->string('hsn_code')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_desc')->nullable();
            $table->string('price')->nullable();
            $table->string('units')->nullable();
            $table->string('gst')->nullable();
            $table->string('igst')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('in_stocks')->nullable();
            $table->string('in_market')->nullable();
            $table->string('user_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

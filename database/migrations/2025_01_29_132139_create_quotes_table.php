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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('billing_address');
            $table->string('shipping_address');
            $table->string('quote_number');
            $table->string('quote_date');
            $table->string('expiry_date');
            $table->string('sub_total');
            $table->string('discount_percentage');
            $table->string('discount_amount');
            $table->string('adjustment');
            $table->string('grant_total');
            $table->string('customer_note');
            $table->string('terms');
            $table->string('status');
            $table->string('user_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};

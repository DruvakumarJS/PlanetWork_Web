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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_no');
            $table->string('customer_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('salutaion')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();  
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('gst')->nullable();
            $table->string('treatment')->nullable();
            $table->string('pan')->nullable();
            $table->string('payment')->nullable();
            $table->string('supply')->nullable();
            $table->string('user_id')->nullable();
            $table->string('enquiry_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

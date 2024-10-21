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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
    $table->unsignedBigInteger('product_id');
    $table->unsignedBigInteger('user_id');  // Foreign key to track the purchaser
    $table->integer('quantity');            // To track quantity purchased
    $table->timestamps();
    
    // Foreign key constraints
    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
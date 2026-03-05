<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dealer_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dealer_id')->constrained('dealer')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('stock_qty')->default(0);
            $table->timestamps();
            
            $table->unique(['dealer_id', 'product_id']);
            $table->index('dealer_id');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dealer_product');
    }
};

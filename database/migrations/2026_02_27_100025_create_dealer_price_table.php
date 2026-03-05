<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dealer_price', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dealer_id')->constrained('dealer')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->decimal('price', 12, 2);
            $table->integer('discount_percent')->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('final_price', 12, 2);
            $table->date('effective_from')->nullable();
            $table->date('effective_till')->nullable();
            $table->timestamps();
            
            $table->unique(['dealer_id', 'product_id']);
            $table->index('dealer_id');
            $table->index('product_id');
            $table->index('effective_from');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dealer_price');
    }
};

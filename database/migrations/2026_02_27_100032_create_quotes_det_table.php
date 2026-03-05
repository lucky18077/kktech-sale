<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotes_det', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->constrained('quotes_mst')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('restrict');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 12, 2);
            $table->integer('discount_percent')->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('line_total', 12, 2);
            $table->text('remarks')->nullable();
            $table->timestamps();
            
            $table->index('quote_id');
            $table->index('product_id');
            // ensure quote-product pair is unique
            $table->unique(['quote_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes_det');
    }
};

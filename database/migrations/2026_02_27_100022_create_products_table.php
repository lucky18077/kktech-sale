<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique();
            $table->string('product_name');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories')->onDelete('set null');
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('stock_qty')->default(0);
            $table->text('description')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('cost_price', 12, 2)->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            
            // Performance indexes
            $table->index('product_code');
            $table->index(['category_id', 'subcategory_id']);
            $table->index('active');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

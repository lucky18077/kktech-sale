<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->integer('discount_percent')->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->date('effective_from')->nullable();
            $table->date('effective_till')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            
            $table->index('category_id');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_discount');
    }
};

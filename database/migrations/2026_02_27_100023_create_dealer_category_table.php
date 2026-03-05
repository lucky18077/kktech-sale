<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dealer_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dealer_id')->constrained('dealer')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
            
            // Unique combination to prevent duplicates
            $table->unique(['dealer_id', 'category_id']);
            $table->index('dealer_id');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dealer_category');
    }
};

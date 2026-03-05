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
        Schema::create('product_categories', function (Blueprint $table) {
          $table->id();
          $table->text('name');
          $table->integer('active');
          $table->timestamp('created_at');
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('categories');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
        Schema::create('categories', function (Blueprint $table) {
          $table->id();
          $table->text('name');
          $table->integer('active');
          $table->timestamp('created_at');
        });
    }
};

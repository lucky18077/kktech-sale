<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('area_mst', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->integer('active')->default(1);
            
            // Performance indexes
            $table->index(['city', 'state']);
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area_mst');
    }
};

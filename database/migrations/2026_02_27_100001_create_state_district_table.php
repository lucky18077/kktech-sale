<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create state_district table (foundation for location hierarchy)
        Schema::create('state_district', function (Blueprint $table) {
            $table->id();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->timestamps();
            
            // Indexes for optimization
            $table->index(['state', 'district']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('state_district');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_stage', function (Blueprint $table) {
            $table->id();
            $table->string('stage_name');
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_stage');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temp', function (Blueprint $table) {
            $table->id();
            $table->string('temp_key')->nullable();
            $table->longText('temp_value')->nullable();
            $table->timestamps();
            
            $table->index('temp_key');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temp');
    }
};

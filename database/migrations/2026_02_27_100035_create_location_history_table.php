<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Renamed from localtion_history to location_history (typo fix)
        Schema::create('location_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('location_name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->decimal('accuracy', 10, 2)->nullable(); // GPS accuracy in meters
            $table->string('device_info')->nullable();
            $table->timestamps();
            
            // Composite indexes for location queries
            $table->index('user_id');
            $table->index(['user_id', 'created_at']);
            $table->index(['latitude', 'longitude']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_history');
    }
};

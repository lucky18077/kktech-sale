<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->text('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('company_name')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            
            // Performance indexes
            $table->index(['state', 'city']);
            $table->index('email');
            $table->index('active');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};

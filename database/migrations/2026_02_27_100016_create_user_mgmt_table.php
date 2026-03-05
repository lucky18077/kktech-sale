<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_mgmt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('role');
            $table->integer('can_add')->default(0);
            $table->integer('can_edit')->default(0);
            $table->integer('can_delete')->default(0);
            $table->integer('can_view')->default(1);
            $table->integer('can_export')->default(0);
            $table->timestamps();
            
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_mgmt');
    }
};

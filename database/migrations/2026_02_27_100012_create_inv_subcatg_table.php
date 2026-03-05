<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inv_subcatg', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catg_id')->constrained('inv_catg')->onDelete('cascade');
            $table->string('subcat_name');
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            
            $table->index('catg_id');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inv_subcatg');
    }
};

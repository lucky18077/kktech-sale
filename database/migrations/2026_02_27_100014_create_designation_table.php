<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('designation', function (Blueprint $table) {
            $table->id();
            $table->string('desig_name');
            $table->foreignId('dept_id')->nullable()->constrained('department')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            
            $table->index('dept_id');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('designation');
    }
};

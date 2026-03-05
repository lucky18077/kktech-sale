<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('office_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('team_name')->nullable();
            $table->foreignId('dept_id')->nullable()->constrained('department')->onDelete('set null');
            $table->integer('active')->default(1);
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('dept_id');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('office_team');
    }
};

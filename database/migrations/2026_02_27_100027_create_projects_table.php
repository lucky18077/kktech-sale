<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('description')->nullable();
            $table->foreignId('property_stage_id')->nullable()->constrained('property_stage')->onDelete('set null');
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('address')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('property_stage_id');
            $table->index(['city', 'state']);
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

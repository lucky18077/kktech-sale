<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mep', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('mep_type'); // Mechanical, Electrical, Plumbing, or combinations
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('PENDING');
            $table->date('planned_date')->nullable();
            $table->date('actual_date')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('project_id');
            $table->index('assigned_to');
            $table->index(['status', 'planned_date']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mep');
    }
};

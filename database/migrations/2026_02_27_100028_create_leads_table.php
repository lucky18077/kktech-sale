<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_ref_no')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('contact_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->foreignId('area_id')->nullable()->constrained('area_mst')->onDelete('set null');
            $table->string('status')->default('NEW LEAD');
            $table->foreignId('source_id')->nullable()->constrained('sources')->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->date('lead_date')->default(now());
            $table->dateTime('last_contact_date')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            
            // High-priority performance indexes for lead queries
            $table->index(['status', 'lead_date']);
            $table->index(['user_id', 'active']);
            $table->index(['state', 'city']);
            $table->index('email');
            $table->index('contact_number');
            $table->index('source_id');
            $table->index('project_id');
            $table->index('created_at');
            $table->index('lead_date');
            
            // Composite indexes for common queries
            $table->index(['user_id', 'status', 'lead_date']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

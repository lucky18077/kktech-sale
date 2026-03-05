<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->longText('comment');
            $table->integer('is_internal')->default(0); // 1 = internal note, 0 = client visible
            $table->timestamps();
            $table->softDeletes();
            
            // Performance indexes for comment retrieval
            $table->index('lead_id');
            $table->index('user_id');
            $table->index(['lead_id', 'created_at']);
            $table->index('is_internal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_comments');
    }
};

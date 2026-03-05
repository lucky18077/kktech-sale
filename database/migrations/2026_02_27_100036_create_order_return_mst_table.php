<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_return_mst', function (Blueprint $table) {
            $table->id();
            $table->string('return_no')->unique();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('restrict');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('reason');
            $table->text('description')->nullable();
            $table->string('status')->default('PENDING'); // PENDING, APPROVED, REJECTED, COMPLETED
            $table->decimal('refund_amount', 14, 2)->default(0);
            $table->date('return_date')->default(now());
            $table->date('approval_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('return_no');
            $table->index('sale_id');
            $table->index('user_id');
            $table->index(['status', 'return_date']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_return_mst');
    }
};

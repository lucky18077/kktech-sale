<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotes_mst', function (Blueprint $table) {
            $table->id();
            $table->string('quote_no')->unique();
            $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->integer('discount_percent')->default(0);
            $table->decimal('discount_amount', 14, 2)->default(0);
            $table->decimal('tax_amount', 14, 2)->default(0);
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->string('status')->default('DRAFT'); // DRAFT, SENT, APPROVED, REJECTED
            $table->date('quote_date')->default(now());
            $table->date('valid_till')->nullable();
            $table->text('notes')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Performance indexes
            $table->index('quote_no');
            $table->index('lead_id');
            $table->index('user_id');
            $table->index(['status', 'quote_date']);
            $table->index(['user_id', 'status']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes_mst');
    }
};

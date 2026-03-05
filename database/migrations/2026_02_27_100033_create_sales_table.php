<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_no')->unique();
            $table->foreignId('lead_id')->constrained('leads')->onDelete('restrict');
            $table->foreignId('quote_id')->nullable()->constrained('quotes_mst')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('dealer_id')->nullable()->constrained('dealer')->onDelete('set null');
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->integer('discount_percent')->default(0);
            $table->decimal('discount_amount', 14, 2)->default(0);
            $table->decimal('tax_amount', 14, 2)->default(0);
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->decimal('paid_amount', 14, 2)->default(0);
            $table->string('payment_status')->default('PENDING'); // PENDING, PARTIAL, COMPLETED
            $table->string('delivery_status')->default('PENDING');
            $table->date('sale_date')->default(now());
            $table->date('delivery_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // High-priority performance indexes
            $table->index('sale_no');
            $table->index('lead_id');
            $table->index('user_id');
            $table->index('dealer_id');
            $table->index(['payment_status', 'sale_date']);
            $table->index(['user_id', 'sale_date']);
            $table->index(['delivery_status', 'sale_date']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

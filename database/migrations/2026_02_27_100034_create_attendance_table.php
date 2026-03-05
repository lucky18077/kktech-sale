<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('attendance_date');
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->decimal('hours_worked', 5, 2)->nullable();
            $table->string('status')->default('PRESENT'); // PRESENT, ABSENT, LEAVE
            $table->text('remarks')->nullable();
            $table->timestamps();
            
            // Composite unique index
            $table->unique(['user_id', 'attendance_date']);
            $table->index('user_id');
            $table->index(['attendance_date', 'status']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('token')->nullable()->after('password');
            $table->timestamp('last_login')->nullable()->after('token');
            $table->string('last_ip')->nullable()->after('last_login');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['token', 'last_login', 'last_ip']);
        });
    }
};

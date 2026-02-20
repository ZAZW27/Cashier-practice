<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prof_pic')->default('default.png'); 
            $table->enum('role', ['admin', 'user'])->default('user'); 
            $table->string('phone_number')->nullable(); // Changed to string for safety!
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['prof_pic', 'role', 'phone_number']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable;
            $table->string('email')->unique();
            $table->string('password')->nullable(); // Nullable for social logins
            $table->string('google_id')->nullable(); // For Google login
            $table->string('facebook_id')->nullable(); // For Facebook login
            $table->string('avatar')->nullable(); // To store profile pictures from social accounts
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

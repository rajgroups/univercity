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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('student_name', 255);
            $table->string('father_name', 255)->nullable();
            $table->string('mother_name', 255)->nullable();
            $table->string('gender', 50);
            $table->date('dob')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('email', 255)->nullable();
            
            // Address Information
            $table->string('state', 255)->nullable();
            $table->string('district', 255)->nullable();
            $table->string('city', 255)->nullable();
            
            // Education Information
            $table->string('skill_sector', 255)->nullable();
            $table->string('level', 50)->nullable();
            $table->string('qualification', 255)->nullable();
            
            // Status and Preferences
            $table->string('status', 50)->nullable();
            $table->string('learning_mode', 50)->nullable();
            $table->string('work_experience', 255)->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Indexes
            $table->index('email');
            $table->index('mobile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

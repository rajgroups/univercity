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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('name');                       // Volunteer Name
            $table->string('mobile');                     // Mobile Number
            $table->enum('gender', ['Male','Female','Other']); // Gender
            $table->date('dob');                          // Date of Birth
            $table->string('qualification')->nullable();  // Qualification
            $table->string('location');                   // Location
            $table->enum('experience', ['Yes','No']);     // Volunteer Experience
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};

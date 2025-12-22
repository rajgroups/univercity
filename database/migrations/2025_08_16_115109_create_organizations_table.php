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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            
            // Organization Details
            $table->string('name');
            $table->string('organization_type'); // Institution/Industry/International Collaboration/CSR/NGO
            $table->string('website')->nullable();
            
            // Contact Person Details
            $table->string('contact_name');
            $table->string('contact_designation');
            $table->string('contact_number');
            $table->string('contact_email');
            
            // Address Details
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('district');
            $table->string('city_village')->nullable();
            $table->string('pincode')->nullable();
            
            // Partnership Interest
            $table->string('collaboration'); // Skill Training/Internship/etc
            $table->string('beneficiary'); // School/College/etc
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};

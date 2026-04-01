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
        Schema::create('enquiry', function (Blueprint $table) {
            $table->id();
            $table->string('name');                           // User name
            $table->string('email')->nullable();                          // User email
            $table->string('mobile', 15);                     // Mobile number
            $table->tinyInteger('type')->default(1)
                  ->comment('1=General, 2=Sponsorship, 3=Volunteering, 4=Partnership, 5=Support, 6=Feedback, 7=Course, 8=>event, 9=>Compettion');
            $table->text('message')->nullable();              // Message / description
            $table->boolean('is_philanthropist')->default(false)->nullable(); // Checkbox
            $table->boolean('paid')->default(false)->nullable();
            $table->boolean('status')->default(1);            // 1=active, 0=inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry');
    }
};

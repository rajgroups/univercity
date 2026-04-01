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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Sector relationship
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id')
                  ->references('id')
                  ->on('sectors')
                  ->onDelete('set null');

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('level', 50)->nullable();
            $table->string('image')->nullable();
            $table->unsignedSmallInteger('duration_number')->nullable()->comment('Duration numeric value');
            $table->enum('duration_unit', ['days', 'weeks', 'months', 'years'])->nullable()->comment('Duration unit');

            // Use enum for predefined values
            $table->enum('paid_type', ['free', 'paid', 'na'])->default('na');

            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();

            $table->string('provider')->nullable();
            $table->string('certification_type')->nullable();
            $table->string('assessment_mode', 100)->nullable();

            $table->string('course_code', 50)->nullable();
            $table->string('nsqf_level', 10)->nullable();
            $table->string('location')->nullable();

            // Use tinyInteger for mode_of_study with number codes
            $table->unsignedTinyInteger('mode_of_study')->nullable()->comment('1=>Online, 2=>In-Centre, 3=>Hybrid, 4=>On-Demand');

            $table->string('program_by')->nullable();
            $table->string('initiative_of')->nullable();

            $table->boolean('internship')->nullable()->default(false);
            $table->string('domain', 100)->nullable();
            $table->string('occupations')->nullable();

            $table->string('required_age', 50)->nullable();
            $table->string('minimum_education')->nullable();

            $table->unsignedTinyInteger('industry_experience_years')->nullable()->default(0);
            $table->text('industry_experience_desc')->nullable();
            $table->text('learning_tools')->nullable();

            $table->json('topics')->nullable();
            $table->json('other_specifications')->nullable();
            $table->json('language')->nullable();
            $table->json('gallery')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->unsignedInteger('enrollment_count')->default(0);

            $table->timestamps();

            // Add indexes for better performance
            $table->index('sector_id');
            $table->index('status');
            $table->index('is_featured');
            $table->index('paid_type');
            $table->index('mode_of_study');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['sector_id']);
        });

        Schema::dropIfExists('courses');
    }
};

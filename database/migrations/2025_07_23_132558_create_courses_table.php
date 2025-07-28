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
            $table->string('slug')->unique(); // SEO-friendly URL
            $table->string('short_name')->nullable(); // e.g., "M.Sc", "AI/ML"
            $table->string('image')->nullable(); // Store image path
            $table->string('duration')->nullable();
            $table->string('paid_type')->comment('Free / Paid');

            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable(); // For detailed course info

            $table->string('provider')->nullable(); // Training Partner
            $table->string('language')->default('English');
            $table->string('certification_type')->nullable(); // e.g. Certificate of Completion
            $table->string('assessment_mode')->nullable(); // e.g. Proctor Assessment

            $table->string('qp_code')->nullable(); // e.g. Non QP Aligned
            $table->string('nsqf_level')->nullable(); // e.g. Non QP Aligned
            $table->string('credits_assigned')->nullable(); // e.g. No Credit Available
            $table->string('learning_product_type')->nullable(); // e.g. Skill Course

            $table->string('program_by')->nullable(); // e.g. Skill India CSR
            $table->string('initiative_of')->nullable(); // e.g. Reliance Foundation

            $table->string('program')->nullable(); // e.g. Reliance Foundation Skilling Academy
            $table->string('domain')->nullable(); // e.g. Airline
            $table->string('occupations')->nullable(); // e.g. Customer Service

            $table->string('required_age')->nullable(); // e.g. Any
            $table->string('minimum_education')->nullable(); // e.g. 12th Pass, ITI, Diploma
            $table->string('industry_experience')->nullable(); // e.g. 0
            $table->string('learning_tools')->nullable(); // e.g. NA

            $table->json('topics')->nullable(); // Dynamic inputs as JSON
            $table->boolean('is_featured')->default(0); // For home page highlighting
            $table->boolean('status')->default(1)->comment('1 => Active, 0 => Inactive');
            $table->date('start_date')->nullable(); // Optional
            $table->date('end_date')->nullable(); // Optional
            $table->unsignedInteger('enrollment_count')->default(0); // For analytics

            $table->timestamps();
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

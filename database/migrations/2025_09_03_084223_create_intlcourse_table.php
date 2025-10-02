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
        Schema::create('intlcourse', function (Blueprint $table) {
            $table->id();

            // Provider & Affiliation Details
            $table->string('admin_provider')->nullable();
            $table->string('partner')->nullable();
            $table->string('accreditation_recognition')->nullable();

            // Course Details
            $table->string('course_name');
            $table->string('slug')->nullable()->unique();
            $table->string('level');
            $table->string('image');

            // Sector relationship
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id')
                ->references('id')
                ->on('sectors')
                ->onDelete('set null');

            // Country relationship
            $table->mediumInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('set null');

            // Category relationship
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('set null');

            $table->enum('pathway_type', ['online_pathway', 'onsite_abroad', 'hybrid', 'dual_credit', 'twinning_program']);
            $table->string('language_instruction');
            $table->string('learning_product_type')->nullable();
            $table->enum('paid_type', ['Free', 'Paid'])->default('Free');
            $table->text('short_description');
            $table->text('long_description');

            // Additional Course Details
            $table->string('certification_type')->nullable();
            $table->string('isico_course_code');
            $table->string('international_mapping')->nullable();
            $table->enum('credits_transferable', ['Yes', 'No'])->nullable();
            $table->integer('max_credits')->nullable();
            $table->string('internship')->nullable();

            // Delivery & Assessment
            $table->string('provider');
            $table->string('assessment_mode');
            $table->string('learning_tools');
            $table->string('bridge_modules')->nullable();

            // Eligibility Details
            $table->string('required_age');
            $table->string('minimum_education');
            $table->string('industry_experience');
            $table->string('language_proficiency_requirement')->nullable();
            $table->text('visa_proccess');
            $table->text('other_info');

            // QP & NSQF & Credit
            $table->string('qp_code');
            $table->string('nsqf_level');
            $table->string('credits_assigned');
            $table->string('program_by');
            $table->string('initiative_of');
            $table->string('program');
            $table->string('occupations');

            // Topics (stored as JSON)
            $table->json('topics')->nullable();

            // Logistics & Costs
            $table->string('duration_local')->nullable();
            $table->string('duration_overseas')->nullable();
            $table->string('total_duration')->nullable();
            $table->string('fee_structure')->nullable();
            $table->string('scholarship_funding')->nullable();
            $table->string('accommodation_cost')->nullable();

            // Pathway & Outcomes
            $table->string('next_degree')->nullable();
            $table->json('career_outcomes')->nullable();
            $table->string('international_recognition')->nullable();
            $table->text('pathway_next_courses')->nullable();

            // Dates & Status
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->integer('enrollment_count')->default(0);

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('sector_id');
            $table->index('course_name');
            $table->index('category_id');
            $table->index('country_id');
            $table->index('is_featured');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intlcourses');
    }
};

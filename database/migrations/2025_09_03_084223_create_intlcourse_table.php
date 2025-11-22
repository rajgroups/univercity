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
        Schema::create('intlcourses', function (Blueprint $table) {
            $table->id();

            // Section 1: Provider and Affiliation
            $table->enum('admission_provider', ['ISICO', 'Overseas Partner'])->required();
            $table->string('overseas_partner_institution')->required();
            $table->string('accreditation_recognition')->nullable();

            // Country relationship
            $table->mediumInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('set null');

            // Section 2: Course Information
            $table->string('course_code')->unique()->required();
            $table->string('course_title')->required();
            $table->string('slug')->unique()->required();

            // Sector relationship
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id')
                ->references('id')
                ->on('sectors')
                ->onDelete('set null');

            // Category relationship
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('set null');

            $table->string('certification_type')->required();
            $table->json('language_of_instruction')->required(); // ['English', 'Japanese']
            $table->text('course_details')->required();
            $table->json('topics_syllabus')->required(); // [['module_title' => '', 'outline' => ''], ...]
            $table->string('pathway_type')->required();
            $table->json('mode_of_study')->required(); // ['Online', 'In Centre', ...]
            $table->json('intake_months')->required(); // ['Jan', 'Apr', ...]

            // Section 2: Eligibility
            $table->string('minimum_education')->required();
            $table->integer('minimum_age')->required();
            $table->boolean('work_experience_required')->default(false);
            $table->text('work_experience_details')->nullable();
            $table->string('language_proficiency')->required();

            // Section 3: Course Duration & Fee Structure
            $table->string('course_duration_overseas')->required();
            $table->boolean('internship_included')->default(false);
            $table->string('internship_duration')->nullable();
            $table->text('internship_summary')->nullable();
            $table->boolean('local_training')->default(false);
            $table->string('local_training_duration')->nullable();
            $table->string('total_duration')->required();

            // Section 3(A): Fees Details
            $table->enum('paid_type', ['Paid', 'Free'])->required();
            $table->json('overseas_fee_breakdown')->nullable(); // [['label' => '', 'amount' => '', 'currency' => ''], ...]
            $table->json('local_training_fee')->nullable(); // [['label' => '', 'amount' => '', 'currency' => ''], ...]
            $table->string('total_fees')->nullable();

            // Section 3(B): Financial Assistance
            $table->boolean('scholarship_available')->default(false);
            $table->text('scholarship_notes')->nullable();
            $table->boolean('bank_loan_assistance')->default(false);
            $table->text('loan_assistance_notes')->nullable();

            // Section 4: Learning Outcomes
            $table->json('career_outcomes')->required(); // ['Junior Software Developer', 'Assistant Chef', ...]
            $table->json('next_pathways')->nullable(); // ['Degree entry', 'Work progression route', ...]

            // Section 5: Visa / Logistics
            $table->boolean('visa_support_included')->default(false);
            $table->text('visa_notes')->nullable();
            $table->boolean('accommodation_support')->default(false);
            $table->text('accommodation_notes')->nullable();
            $table->json('living_costs')->nullable(); // [['label' => '', 'amount' => '', 'currency' => ''], ...]

            // Section 6: FAQ
            $table->json('faqs')->nullable(); // [['question' => '', 'answer' => ''], ...]

            // Section 7: SEO & Media
            $table->json('gallery_images')->nullable(); // ['image1.jpg', 'image2.jpg', ...]
            $table->string('thumbnail_image')->nullable();
            $table->json('course_brochures')->nullable(); // [['document_name' => '', 'file_path' => ''], ...]
            $table->string('short_description', 200)->required();
            $table->text('meta_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('publish_status')->default(false);

            $table->timestamps();
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

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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('project_code')->unique()->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->unsignedBigInteger('category_id')->nullable()->index();

            // Type and Stage
            $table->enum('type', ['1', '2'])->nullable()->comment('1=On Going, 2=Up Coming');
            $table->enum('stage', ['upcoming', 'ongoing', 'completed'])->default('upcoming');

            // Descriptions
            $table->text('short_description');
            $table->longText('description');

            // Media
            $table->string('image')->nullable();
            $table->string('banner_image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('before_after_images')->nullable();

            // Bullet Points (stored as JSON array)
            $table->json('points')->nullable();

            // ========== UPCOMING STAGE FIELDS ==========
            $table->decimal('cost', 15, 2)->nullable()->comment('Estimated cost for upcoming projects');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Beneficiaries (JSON object/array)
            $table->json('beneficiaries')->nullable()->comment('Example: [{"name":"Student","count":100,"description":"desc"}]');

            // Funding
            $table->enum('funding_type', ['csr', 'crowdfunding', 'self-funded', 'donation'])->nullable();
            $table->enum('csr_partner_type', ['corporate', 'ngo', 'government', 'individual'])->nullable();
            $table->text('csr_invitation')->nullable();

            // Crowdfunding / CTA
            $table->enum('crowdfunding_status', ['opening_soon', 'not_started'])->nullable();
            $table->string('cta_button_text')->nullable()->default('Register Your Interest →');
            $table->string('interest_link')->nullable();

            // ========== ONGOING STAGE FIELDS ==========
            $table->string('project_lead')->nullable();
            $table->date('actual_start_date')->nullable();
            $table->date('expected_end_date')->nullable();
            $table->integer('ongoing_beneficiaries')->nullable();
            $table->decimal('project_cost', 15, 2)->nullable();
            $table->string('level')->nullable()->default(1);
            $table->decimal('funding_target', 15, 2)->nullable();
            $table->decimal('amount_raised', 15, 2)->nullable()->default(0);
            $table->enum('ongoing_crowdfunding_status', ['active', 'on_hold', 'closed'])->nullable();
            $table->string('main_donor')->nullable();
            $table->text('isico_message')->nullable();
            $table->json('progress_updates')->nullable()->comment('JSON array of milestone updates [{"date":"","title":"","description":"","image":"","status":""}]');

            // ========== COMPLETED STAGE FIELDS ==========
            $table->string('completed_project_lead')->nullable();
            $table->date('completed_start_date')->nullable();
            $table->date('completed_end_date')->nullable();
            $table->decimal('final_cost', 15, 2)->nullable();
            $table->integer('completed_beneficiaries')->nullable();
            $table->string('completed_csr_partner')->nullable();
            $table->text('impact_summary')->nullable();
            $table->json('outcome_metrics')->nullable()->comment('JSON array of outcome metrics [{"metric":"","value":""}]');
            $table->json('testimonials')->nullable()->comment('JSON array of testimonials [{"name":"","quote":""}]');
            $table->text('sustainability_plan')->nullable();
            $table->text('lessons_learned')->nullable();
            $table->string('completion_report')->nullable();
            $table->string('utilization_certificate')->nullable();
            $table->json('impact_stories')->nullable()->comment('JSON array of impact stories [{"title":"","description":"","image":""}]');

            // SDGs (store as JSON array of IDs)
            $table->json('sdgs')->nullable();

            // Common
            $table->boolean('status')->default(1)->comment('1=Active, 0=Inactive');

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('set null');
        });

        // Status Logs
        Schema::create('project_status_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->unsignedBigInteger('changed_by')->nullable();
            $table->timestamp('changed_at')->useCurrent();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_status_logs');
        Schema::dropIfExists('projects');
    }
};

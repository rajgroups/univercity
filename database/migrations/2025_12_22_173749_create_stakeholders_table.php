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
        Schema::create('stakeholders', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('stakeholder_id')->unique()->comment('Auto-generated stakeholder ID like STKH-001');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name')->virtualAs('CONCAT(first_name, " ", last_name)');

            // Contact Information
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('alternate_phone')->nullable();

            // Company/Organization Details
            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();

            // Stakeholder Type & Classification
            $table->enum('type', [
                'internal',
                'external',
                'client',
                'vendor',
                'partner',
                'government',
                'community',
                'investor'
            ])->default('internal');

            $table->enum('category', [
                'primary',
                'secondary',
                'influencer',
                'decision_maker',
                'approver',
                'user',
                'supplier',
                'regulator'
            ])->default('primary');

            // Communication Preferences
            $table->json('communication_preferences')->nullable()->comment('Preferred communication channels');
            $table->string('preferred_language')->default('en');

            // Address Information
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();

            // Professional Details
            $table->string('industry')->nullable();
            $table->string('expertise_area')->nullable();
            $table->text('biography')->nullable();

            // Social Media & Links
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('website_url')->nullable();

            // Stakeholder Engagement Metrics
            $table->integer('engagement_level')->default(1)->comment('1-5 scale');
            $table->enum('influence_level', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('interest_level', ['low', 'medium', 'high'])->default('medium');

            // Project Relations (Pivot data would be in separate table)
            $table->json('assigned_projects')->nullable()->comment('Array of project IDs');
            $table->json('involved_phases')->nullable()->comment('Array of phases involved in');

            // Status & Timestamps
            $table->enum('status', [
                'active',
                'inactive',
                'pending',
                'archived',
                'blocked'
            ])->default('active');

            $table->date('last_contacted')->nullable();
            $table->date('next_follow_up')->nullable();

            // Additional Metadata
            $table->json('metadata')->nullable()->comment('Custom fields or additional data');
            $table->text('notes')->nullable();

            // Soft Deletes & Timestamps
            $table->softDeletes();
            $table->timestamps();

            // Indexes for performance
            $table->index(['type', 'status']);
            $table->index(['category', 'engagement_level']);
            $table->index(['company_name', 'designation']);
            $table->index('last_contacted');
        });

        // Create stakeholder_project pivot table
        Schema::create('stakeholder_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stakeholder_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->enum('role', [
                'project_manager',
                'team_member',
                'client_representative',
                'vendor',
                'consultant',
                'approver',
                'reviewer',
                'observer'
            ])->default('team_member');
            $table->enum('access_level', ['view', 'edit', 'admin', 'owner'])->default('view');
            $table->json('assigned_phases')->nullable()->comment('Phases assigned to this stakeholder');
            $table->decimal('involvement_percentage', 5, 2)->nullable()->comment('Percentage involvement in project');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['stakeholder_id', 'project_id']);
            $table->index(['project_id', 'role']);
        });

        // Create stakeholder_communication_log table
        Schema::create('stakeholder_communications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stakeholder_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('communicator_id')->nullable()->constrained('users')->onDelete('set null');

            $table->enum('communication_type', [
                'email',
                'meeting',
                'phone_call',
                'video_conference',
                'presentation',
                'report',
                'notification'
            ]);

            $table->string('subject');
            $table->text('message')->nullable();
            $table->json('attachments')->nullable();
            $table->enum('direction', ['incoming', 'outgoing', 'internal']);
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');

            // Response tracking
            $table->boolean('requires_response')->default(false);
            $table->boolean('response_received')->default(false);
            $table->timestamp('response_due_date')->nullable();
            $table->timestamp('response_received_at')->nullable();

            // Status
            $table->enum('status', [
                'scheduled',
                'sent',
                'delivered',
                'read',
                'responded',
                'cancelled',
                'failed'
            ])->default('scheduled');

            // Feedback
            $table->integer('satisfaction_score')->nullable()->comment('1-5 scale');
            $table->text('feedback')->nullable();

            $table->timestamp('sent_at')->nullable();
            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            // Indexes
            // Laravel will automatically generate a shorter name
            $table->index(['stakeholder_id', 'communication_type']);
            $table->index(['project_id', 'status']);
            $table->index('response_due_date');
        });

        // Create stakeholder_feedback table
        Schema::create('stakeholder_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stakeholder_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('feedback_by')->nullable()->constrained('users')->onDelete('set null');

            $table->enum('feedback_type', [
                'satisfaction',
                'performance',
                'collaboration',
                'communication',
                'delivery',
                'general'
            ]);

            $table->integer('rating')->comment('1-5 or 1-10 scale');
            $table->text('comments');
            $table->json('aspects')->nullable()->comment('Specific aspects rated');

            $table->enum('sentiment', ['positive', 'neutral', 'negative'])->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->boolean('action_required')->default(false);
            $table->text('action_taken')->nullable();
            $table->timestamp('action_completed_at')->nullable();

            $table->timestamps();

            $table->index(['stakeholder_id', 'project_id']);
            $table->index(['feedback_type', 'rating']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stakeholder_feedbacks');
        Schema::dropIfExists('stakeholder_communications');
        Schema::dropIfExists('stakeholder_project');
        Schema::dropIfExists('stakeholders');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('stakeholders')) {
            Schema::create('stakeholders', function (Blueprint $table) {
                $table->id();

                /*
                |--------------------------------------------------------------------------
                | Basic Information
                |--------------------------------------------------------------------------
                */
                $table->string('stakeholder_id')->unique()
                    ->comment('Auto-generated stakeholder code like STKH-001');

                $table->string('first_name');
                $table->string('last_name');

                $table->string('full_name')
                    ->virtualAs('CONCAT(first_name, " ", last_name)');

                /*
                |--------------------------------------------------------------------------
                | Contact Information
                |--------------------------------------------------------------------------
                */
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->string('alternate_phone')->nullable();

                /*
                |--------------------------------------------------------------------------
                | Company / Organization
                |--------------------------------------------------------------------------
                */
                $table->string('company_name', 100)->nullable();
                $table->string('designation', 100)->nullable();
                $table->string('department', 100)->nullable();

                /*
                |--------------------------------------------------------------------------
                | Stakeholder Type
                |--------------------------------------------------------------------------
                | 1 = ISICO Core Admin
                | 2 = Training Partner
                | 3 = Learner
                | 4 = Volunteer
                | 5 = Funding Partner
                |--------------------------------------------------------------------------
                */
                $table->tinyInteger('type')
                    ->default(1)
                    ->comment('1=ISICO Core, 2=Training Partner, 3=Learner, 4=Volunteer, 5=Funding Partner');

                /*
                |--------------------------------------------------------------------------
                | Stakeholder Classification / Sub Type
                |--------------------------------------------------------------------------
                | ADMIN:
                | 1 = Super Admin
                | 2 = Program Admin
                | 3 = Coordinator
                |
                | TRAINING PARTNER:
                | 4 = Training Organization
                | 5 = Individual Trainer
                |
                | LEARNER:
                | 6 = Individual Learner
                | 7 = Group Leader
                |
                | VOLUNTEER:
                | 8 = Field Volunteer
                | 9 = Survey Volunteer
                | 10 = Mentor Volunteer
                |
                | FUNDING PARTNER:
                | 11 = CSR
                | 12 = Donor
                | 13 = Sponsor
                | 14 = Foundation
                |--------------------------------------------------------------------------
                */
                $table->tinyInteger('classification')
                    ->default(1)
                    ->comment('Stakeholder sub-type classification');

                /*
                |--------------------------------------------------------------------------
                | Communication Preferences
                |--------------------------------------------------------------------------
                */
                $table->json('communication_preferences')->nullable();
                $table->string('preferred_language')->default('en');

                /*
                |--------------------------------------------------------------------------
                | Address
                |--------------------------------------------------------------------------
                */
                $table->string('address_line_1')->nullable();
                $table->string('address_line_2')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('country')->nullable();
                $table->string('postal_code')->nullable();

                /*
                |--------------------------------------------------------------------------
                | Professional Details
                |--------------------------------------------------------------------------
                */
                $table->string('industry')->nullable();
                $table->string('expertise_area')->nullable();
                $table->text('biography')->nullable();

                /*
                |--------------------------------------------------------------------------
                | Social Links
                |--------------------------------------------------------------------------
                */
                $table->string('linkedin_url')->nullable();
                $table->string('twitter_url')->nullable();
                $table->string('website_url')->nullable();

                /*
                |--------------------------------------------------------------------------
                | Engagement Metrics
                |--------------------------------------------------------------------------
                */
                $table->tinyInteger('engagement_level')
                    ->default(1)
                    ->comment('1-5 scale');

                $table->tinyInteger('influence_level')
                    ->default(2)
                    ->comment('1=Low, 2=Medium, 3=High, 4=Critical');

                $table->tinyInteger('interest_level')
                    ->default(2)
                    ->comment('1=Low, 2=Medium, 3=High');

                /*
                |--------------------------------------------------------------------------
                | Project Relations
                |--------------------------------------------------------------------------
                */
                $table->json('assigned_projects')->nullable();
                $table->json('involved_phases')->nullable();

                /*
                |--------------------------------------------------------------------------
                | Status
                |--------------------------------------------------------------------------
                | 1 = Active
                | 2 = Inactive
                | 3 = Pending
                | 4 = Archived
                | 5 = Blocked
                |--------------------------------------------------------------------------
                */
                $table->tinyInteger('status')
                    ->default(1)
                    ->comment('1=Active, 2=Inactive, 3=Pending, 4=Archived, 5=Blocked');

                $table->date('last_contacted')->nullable();
                $table->date('next_follow_up')->nullable();

                /*
                |--------------------------------------------------------------------------
                | Extra Metadata
                |--------------------------------------------------------------------------
                */
                $table->json('metadata')->nullable();
                $table->text('notes')->nullable();

                $table->softDeletes();
                $table->timestamps();

                /*
                |--------------------------------------------------------------------------
                | Indexes
                |--------------------------------------------------------------------------
                */
                $table->index(['type', 'status']);
                $table->index(['classification', 'engagement_level']);
                $table->index(['company_name', 'designation']);
                $table->index('last_contacted');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('stakeholders');
    }
};
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
        Schema::create('homesetting', function (Blueprint $table) {
            $table->id();

            // About Section
            $table->string('about_main_title')->nullable();
            $table->string('about_sub_title')->nullable();
            $table->string('about_title')->nullable(); // Corresponds to empowering_title
            $table->text('about_description')->nullable();

            // Operate Section (Dynamic - will store as JSON)
            // This will store an array of objects, each with operate_title, operate_desc, and operate_icon (path)
            $table->string('operate_main_title')->nullable();
            $table->string('operate_sub_title')->nullable(); // Corresponds to Learning Subtitle
            $table->json('operate_sections')->nullable();

            // Ongoing Section
            $table->string('on_going_project_title')->nullable();
            $table->string('on_going_project_main_title')->nullable();
            $table->string('on_going_project_main_sub_title')->nullable();
            $table->string('onging_final_title')->nullable();

            // Upcoming Section
            $table->string('upcoming_project_title')->nullable();
            $table->string('upcoming_project_main_title')->nullable();
            $table->string('upcoming_project_main_sub_title')->nullable();
            $table->string('upcoming_final_title')->nullable();
            $table->string('upcoming_secondary_title')->nullable();
            $table->text('upcoming_secondary_desc')->nullable();

            // Program Section
            $table->string('program_project_title')->nullable();
            $table->string('program_project_main_title')->nullable();
            $table->string('program_project_main_sub_title')->nullable();
            $table->string('program_final_title')->nullable();

            // Core Values Section
            $table->string('core_title_one')->nullable();
            $table->string('core_title_two')->nullable();
            $table->string('core_image')->nullable(); // Stores the path to the image

            // Ongoing Section
            $table->string('gvt_scheme_title')->nullable();
            $table->string('gvt_scheme_main_title')->nullable();
            $table->string('gvt_scheme_main_sub_title')->nullable();
            $table->string('gvt_scheme_final_title')->nullable();

            // Key Areas of Focus (Dynamic - will store as JSON)
            // This will store an array of objects, each with focus_title and focus_description
            $table->string('focus_main_title')->nullable();
            $table->json('focus_areas')->nullable();

            // Message from Founder
            $table->text('founder_message')->nullable();
            $table->string('founder_name')->nullable();

            // Future Goals (Dynamic - will store as JSON)
            // This will store an array of objects, each with goal_title and goal_description
            $table->json('future_goals')->nullable();

            // International Collaboration (Dynamic - will store as JSON)
            // This will store an array of objects, each with collaboration_ques, collaboration_ans, and collaboration_icon (path)
            $table->string('collaboration_main_title')->nullable();
            $table->string('collaboration_sub_title')->nullable();
            $table->json('international_collaborations')->nullable();

            $table->boolean('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

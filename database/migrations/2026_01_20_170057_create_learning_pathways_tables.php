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
        // Main Learning Pathways Table
        Schema::create('learning_pathways', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id'); // FK to projects
            $table->unsignedBigInteger('primary_sector_id')->nullable(); // FK to sectors
            $table->text('learning_outcomes')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('primary_sector_id')->references('id')->on('sectors')->onDelete('set null');
        });

        // Pivot Table: Learning Pathway <-> Sectors (Multi-select)
        Schema::create('learning_pathway_sectors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learning_pathway_id');
            $table->unsignedBigInteger('sector_id');
            $table->integer('display_order')->default(0);

            $table->foreign('learning_pathway_id')->references('id')->on('learning_pathways')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
        });

        // Tab 2: Multidisciplinary Flow
        Schema::create('learning_pathway_flows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learning_pathway_id');
            $table->integer('step_no');
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->string('step_title')->nullable();
            $table->text('description')->nullable();
            $table->text('skills_text')->nullable();
            $table->timestamps();

            $table->foreign('learning_pathway_id')->references('id')->on('learning_pathways')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('set null');
        });

        // Tab 3: Training Courses (Pivot with extra fields)
        Schema::create('learning_pathway_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learning_pathway_id');
            $table->unsignedBigInteger('course_id');
            $table->integer('display_order')->default(0);
            $table->boolean('is_featured')->default(false);

            $table->foreign('learning_pathway_id')->references('id')->on('learning_pathways')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        // Tab 4: Learning Path Roadmap
        Schema::create('learning_pathway_roadmaps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learning_pathway_id');
            $table->integer('step_no');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('color')->nullable(); // e.g., hex code or class name
            $table->timestamps();

            $table->foreign('learning_pathway_id')->references('id')->on('learning_pathways')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_pathway_roadmaps');
        Schema::dropIfExists('learning_pathway_courses');
        Schema::dropIfExists('learning_pathway_flows');
        Schema::dropIfExists('learning_pathway_sectors');
        Schema::dropIfExists('learning_pathways');
    }
};

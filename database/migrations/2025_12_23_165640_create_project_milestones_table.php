<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_milestones', function (Blueprint $table) {
            $table->id();

            // 🔗 Foreign Keys
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('stakeholder_id')
                ->constrained('stakeholders')
                ->cascadeOnDelete();

            // 📌 Task Details
            $table->string('phase', 5); // P1, P2, ...
            $table->string('task_name');

            // 📅 Planned Dates
            $table->date('planned_start_date')->nullable();
            $table->date('planned_end_date')->nullable();

            // 👤 Responsibility
            $table->string('in_charge')->nullable();

            // ⚡ Priority & Status
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])
                  ->default('medium');

            $table->enum('status', [
                'pending',
                'in-progress',
                'completed',
                'on-hold',
                'cancelled'
            ])->default('pending');

            // 📊 Progress
            $table->unsignedTinyInteger('progress')->default(0);

            // 📝 Notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // 🚀 Indexes (Performance)
            $table->index(['project_id', 'stakeholder_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_milestones');
    }
};

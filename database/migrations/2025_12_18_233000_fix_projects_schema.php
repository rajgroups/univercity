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
        Schema::table('projects', function (Blueprint $table) {
            // Add location_type if missing
            if (!Schema::hasColumn('projects', 'location_type')) {
                $table->string('location_type')->nullable();
            }

            // Add target_location_type if missing
            if (!Schema::hasColumn('projects', 'target_location_type')) {
                $table->enum('target_location_type', ['single', 'multiple'])->default('single');
            }

            // Add show_map_preview if missing
            if (!Schema::hasColumn('projects', 'show_map_preview')) {
                $table->boolean('show_map_preview')->default(false);
            }

             // Add last_update_summary if missing
             if (!Schema::hasColumn('projects', 'last_update_summary')) {
                $table->text('last_update_summary')->nullable();
            }

            // Add actual_beneficiary_count if missing
            if (!Schema::hasColumn('projects', 'actual_beneficiary_count')) {
                $table->integer('actual_beneficiary_count')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'location_type')) {
                $table->dropColumn('location_type');
            }
            if (Schema::hasColumn('projects', 'target_location_type')) {
                $table->dropColumn('target_location_type');
            }
            if (Schema::hasColumn('projects', 'show_map_preview')) {
                $table->dropColumn('show_map_preview');
            }
             if (Schema::hasColumn('projects', 'last_update_summary')) {
                $table->dropColumn('last_update_summary');
            }
            if (Schema::hasColumn('projects', 'actual_beneficiary_count')) {
                $table->dropColumn('actual_beneficiary_count');
            }
        });
    }
};

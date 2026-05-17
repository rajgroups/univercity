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
        Schema::table('learning_pathways', function (Blueprint $table) {
            if (!Schema::hasColumn('learning_pathways', 'flow_title')) {
                $table->string('flow_title')->nullable()->after('primary_sector_id');
            }
            if (!Schema::hasColumn('learning_pathways', 'roadmap_title')) {
                $table->string('roadmap_title')->nullable()->after('flow_title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learning_pathways', function (Blueprint $table) {
            $table->dropColumn(['flow_title', 'roadmap_title']);
        });
    }
};

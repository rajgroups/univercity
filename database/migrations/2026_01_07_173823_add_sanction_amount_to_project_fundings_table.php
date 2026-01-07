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
        Schema::table('project_fundings', function (Blueprint $table) {
            $table->decimal('sanction_amount', 15, 2)->default(0)->after('source_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_fundings', function (Blueprint $table) {
            $table->dropColumn('sanction_amount');
        });
    }
};

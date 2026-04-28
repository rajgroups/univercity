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
        Schema::table('project_donors', function (Blueprint $table) {
            $table->string('payment_status')->default('Committed')->change();
            $table->date('received_date')->nullable()->after('payment_status');
        });

        Schema::table('project_utilizations', function (Blueprint $table) {
            $table->string('funding_source')->nullable()->after('phase'); // CSR / Crowdfunding
            $table->string('status')->default('Pending')->after('funding_source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_donors', function (Blueprint $table) {
            $table->dropColumn('received_date');
        });

        Schema::table('project_utilizations', function (Blueprint $table) {
            $table->dropColumn(['funding_source', 'status']);
        });
    }
};

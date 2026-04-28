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
            $table->boolean('crowdfunding_active')->default(false)->after('status');
            $table->decimal('funding_target', 15, 2)->default(0)->after('crowdfunding_active');
            $table->decimal('amount_raised', 15, 2)->default(0)->after('funding_target');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['crowdfunding_active', 'funding_target', 'amount_raised']);
        });
    }
};

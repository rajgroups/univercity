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
        Schema::table('survey_responses', function (Blueprint $table) {
            // Drop the incorrect foreign key referencing 'surveys'
            // $table->dropForeign('survey_responses_survey_id_foreign');

            // Add the correct foreign key referencing 'scrutiny'
            $table->foreign('survey_id')
                  ->references('id')
                  ->on('scrutiny')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_responses', function (Blueprint $table) {
            $table->dropForeign(['survey_id']);

            // Revert to the previous state (referencing surveys)
            $table->foreign('survey_id')
                  ->references('id')
                  ->on('surveys')
                  ->onDelete('cascade');
        });
    }
};

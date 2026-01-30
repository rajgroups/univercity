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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('availability_status')->default('available')->after('status')->nullable();
            $table->integer('review_stars')->nullable()->after('availability_status');
            $table->integer('review_count')->nullable()->after('review_stars');
            $table->text('internship_note')->nullable()->after('internship');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['availability_status', 'review_stars', 'internship_note']);
        });
    }
};

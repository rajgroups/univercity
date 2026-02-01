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
        Schema::create('project_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->enum('type', ['group', 'individual']); // 'group' or 'individual'
            $table->string('category');
            $table->integer('target_number')->default(0);
            $table->integer('reached_number')->default(0);
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::create('project_beneficiary_updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_beneficiary_id');
            $table->integer('reached_number');
            $table->date('date');
            $table->timestamps();

            $table->foreign('project_beneficiary_id')->references('id')->on('project_beneficiaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_beneficiary_updates');
        Schema::dropIfExists('project_beneficiaries');
    }
};

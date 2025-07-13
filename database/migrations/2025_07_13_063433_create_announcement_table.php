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
        Schema::create('announcement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_by')->constrained('admin')->comment('Posted by admin');
            $table->string('title')->comment('announcement title');
            $table->string('type')->comment('announcement type');
            $table->string('banner')->nullable();
            $table->string('image');
            $table->longText('description');
            $table->boolean('alert')->default(0);
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcement');
    }
};

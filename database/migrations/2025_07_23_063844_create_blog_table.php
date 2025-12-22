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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('menu_title')->nullable();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('category')  // refers to 'id' in 'category' table
                ->onDelete('restrict');    // stop delete if child (project) exists
            $table->longText('subtitle')->nullable();
            $table->longText('short_description');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('banner_image')->nullable();
            $table->tinyInteger('type')->comment('1=>blog,2=>news,3=>collaboration,4=>Training Model,5=>Research and Publocation,6=>case studies,7=>resource')->default(1);
            $table->longText('description')->nullable();
            $table->json('points')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};

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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(1)->comment('1=>event', '2=>competition');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('registration_deadline')->nullable();
            $table->string('location');
            $table->string('banner_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->tinyInteger('status')->default(0); // 0=draft, 1=upcoming, etc.
            
            // Competition-specific
            $table->text('rules')->nullable();
            $table->json('highlights')->nullable();
            $table->integer('max_participants')->nullable();
            $table->decimal('entry_fee', 8, 2)->nullable()->default(0);
            
            // Relationships
            $table->unsignedBigInteger('organizer_id')->nullable();
            $table->foreign('organizer_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

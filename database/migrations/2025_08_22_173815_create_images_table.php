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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            
            // Polymorphic relation fields
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type'); 
            
            // Image info
            $table->string('file_name'); // only file name (since you prefer storing filename only)
            $table->string('alt_text')->nullable(); // optional alt text for SEO
            $table->integer('position')->nullable(); // optional for sorting images
            $table->boolean('is_featured')->default(false); // optional featured image
            
            $table->timestamps();

            // Indexes for polymorphic fields
            $table->index(['imageable_id', 'imageable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};

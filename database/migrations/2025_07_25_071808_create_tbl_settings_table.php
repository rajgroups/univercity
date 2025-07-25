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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // General
            $table->string('site_title')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('loader_image')->nullable();

            // Contact Page
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_address')->nullable();
            $table->text('contact_map_embed')->nullable(); // Google Maps iframe

            // About Page
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();

            // Social Media
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();

            // Currency
            $table->string('currency_name')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->decimal('currency_rate', 10, 2)->default(1);

            // Frontend URLs
            $table->string('frontend_url')->nullable();
            $table->string('terms_url')->nullable();
            $table->string('privacy_url')->nullable();

            // SMTP / Email
            $table->boolean('smtp_enabled')->default(false);
            $table->string('smtp_host')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_encryption')->nullable(); // ssl/tls
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('smtp_from_email')->nullable();
            $table->string('smtp_from_name')->nullable();

            // SEO
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('google_analytics_id')->nullable();

            // Footer
            $table->text('footer_text')->nullable();
            $table->string('footer_email')->nullable();
            $table->string('footer_phone')->nullable();
            $table->string('footer_address')->nullable();
            $table->string('footer_copywrite')->nullable();
            $table->string('footer_copyright')->nullable();

            // UI/Theme
            $table->string('primary_color')->nullable();
            $table->string('theme')->nullable(); // light/dark/custom

            // Announcements & Maintenance
            $table->boolean('maintenance_mode')->default(false);
            $table->boolean('announcement_enabled')->default(false);
            $table->text('announcement_text')->nullable();
            $table->string('maintenance_image')->nullable();
            $table->text('maintenance_text')->nullable();

            // Timestamps
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

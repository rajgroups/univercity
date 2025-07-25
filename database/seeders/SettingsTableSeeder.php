<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            // General
            'site_title'        => 'My Awesome Website',
            'site_logo'         => 'default-logo.png',
            'favicon'           => 'favicon.ico',
            'loader_image'      => 'loader.gif',

            // Contact Page
            'contact_email'     => 'support@example.com',
            'contact_phone'     => '+91-9876543210',
            'contact_address'   => '123, Example Street, City, Country',
            'contact_map_embed' => '<iframe src="https://maps.google.com/..."></iframe>',

            // About Page
            'about_title'       => 'About Us',
            'about_description' => 'We are committed to delivering quality service.',
            'about_image'       => 'about-us.jpg',

            // Social Media
            'facebook'          => 'https://facebook.com/example',
            'twitter'           => 'https://twitter.com/example',
            'instagram'         => 'https://instagram.com/example',
            'linkedin'          => 'https://linkedin.com/company/example',
            'youtube'           => 'https://youtube.com/channel/example',

            // Currency
            'currency_name'     => 'INR',
            'currency_symbol'   => '₹',
            'currency_rate'     => 1.00,

            // Frontend URLs
            'frontend_url'      => 'https://www.example.com',
            'terms_url'         => 'https://www.example.com/terms',
            'privacy_url'       => 'https://www.example.com/privacy',

            // SMTP / Email
            'smtp_enabled'      => true,
            'smtp_host'         => 'smtp.mailtrap.io',
            'smtp_port'         => 587,
            'smtp_encryption'   => 'tls',
            'smtp_username'     => 'your_smtp_user',
            'smtp_password'     => 'your_smtp_pass',
            'smtp_from_email'   => 'noreply@example.com',
            'smtp_from_name'    => 'Example App',

            // SEO
            'meta_keywords'     => 'website, seo, example, business',
            'meta_description'  => 'This is an example SEO meta description.',
            'google_analytics_id' => 'UA-XXXXXXXXX-X',

            // Footer
            'footer_text'       => '© 2025 My Awesome Website. All rights reserved.',
            'footer_email'      => 'footer@example.com',
            'footer_phone'      => '+91-9876543210',
            'footer_address'    => 'Same as contact address',
            'footer_gateway_image' => 'payment-methods.png',
            'footer_copyright' => 'Copyright © 2025.ISICO - INDIAN SKILL INSTUTUTE CO-OPERATION. All rights reserved.',

            // UI/Theme
            'primary_color'     => '#1e88e5',
            'theme'             => 'default',

            // Announcements & Maintenance
            'maintenance_mode'     => false,
            'announcement_enabled' => true,
            'announcement_text'    => 'We have launched new features!',
            'maintenance_image'    => 'maintenance.png',
            'maintenance_text'     => 'We’ll be back soon with improvements!',
        ]);
    }
}

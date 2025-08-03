<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        // General
        'site_title',
        'site_logo',
        'favicon',
        'loader_image',

        // Contact Page
        'contact_email',
        'contact_phone',
        'contact_address',
        'contact_map_embed',

        // About Page
        'about_title',
        'about_description',
        'about_image',

        // Social Media
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',

        // Currency
        'currency_name',
        'currency_symbol',
        'currency_rate',

        // Frontend URLs
        'frontend_url',
        'terms_url',
        'privacy_url',

        // SMTP / Email
        'smtp_enabled',
        'smtp_host',
        'smtp_port',
        'smtp_encryption',
        'smtp_username',
        'smtp_password',
        'smtp_from_email',
        'smtp_from_name',

        // SEO
        'meta_keywords',
        'meta_description',
        'google_analytics_id',

        // Footer
        'footer_text',
        'footer_email',
        'footer_phone',
        'footer_address',
        'footer_copyright',
        'footer_gateway_image',

        // UI/Theme
        'primary_color',
        'theme',

        // Announcements & Maintenance
        'maintenance_mode',
        'announcement_enabled',
        'announcement_text',
        'maintenance_image',
        'maintenance_text',
    ];
}

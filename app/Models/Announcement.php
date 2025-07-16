<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    protected $table = 'announcement'; // Singular table name

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'banner_image',
        'type',
        'status',
    ];

    // Auto-generate slug from title if not provided
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($announcement) {
            if (empty($announcement->slug) && !empty($announcement->title)) {
                $announcement->slug = Str::slug($announcement->title);
            }
        });
    }
}

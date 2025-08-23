<?php

namespace App\Models;

use App\Models\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    use HasFactory, HasImages;
    protected $table = 'announcement'; // Singular table name

    protected $fillable = [
        'title',
        'category_id',
        'subtitle',
        'slug',
        'description',
        'points',
        'short_description',
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

        // Announcement belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

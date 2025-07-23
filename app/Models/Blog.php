<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'subtitle',
        'category_id',
        'slug',
        'description',
        'points',
        'short_description',
        'image',
        'banner_image',
        'type',
        'status',
    ];

    // Program belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

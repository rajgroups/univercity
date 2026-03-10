<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    
    // Specify custom table name since it's not the plural "categories"
    protected $table = 'category';

    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'slug',
        'type',
        'status',
    ];

    /**
     * Category has many announcements
     */
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class, 'category_id');
    }

    /**
     * Category has many projects
     */
    public function programs(): HasMany
    {
        return $this->hasMany(Project::class, 'category_id');
    }

    /**
     * Category has many blogs
     */
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'category_id');
    }

    /**
     * Category has many courses
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'category_id');
    }
    /**
     * Category has many activities
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'category_id');
    }
}

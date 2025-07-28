<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

        // Category has many announcements
    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'category_id');
    }

    // Category has many programs
    public function programs()
    {
        return $this->hasMany(Project::class, 'category_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}

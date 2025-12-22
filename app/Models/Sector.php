<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prefix',
        'slug',
        'image',
        'type',
        'status',
        'description',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

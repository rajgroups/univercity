<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'alt_text',
        'position',
        'is_featured',
    ];

    /**
     * Get the parent model (user, post, product, etc.)
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}

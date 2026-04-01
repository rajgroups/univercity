<?php

namespace App\Models\Traits;

use App\Models\Image;

trait HasImages
{
    /**
     * Polymorphic relationship
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get only featured image
     */
    public function featuredImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_featured', true);
    }
}

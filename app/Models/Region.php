<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $fillable = ['name'];

    /**
     * A region has many countries.
     */
    public function countries()
    {
        return $this->hasMany(Country::class, 'region_id');
    }
}

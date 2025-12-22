<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subregion extends Model
{
    use HasFactory;
        protected $table = 'subregions';
    protected $fillable = ['name', 'region_id'];

    /**
     * A subregion belongs to a region.
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * A subregion has many countries.
     */
    public function countries()
    {
        return $this->hasMany(Country::class, 'subregion_id');
    }
}

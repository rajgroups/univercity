<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimationItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function estimation()
    {
        return $this->belongsTo(ProjectEstimation::class, 'estimation_id');
    }
}

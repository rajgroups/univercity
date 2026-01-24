<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPathwayRoadmap extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_pathway_id',
        'step_no',
        'title',
        'description',
        'badge_text',
        'color',
    ];

    public function learningPathway()
    {
        return $this->belongsTo(LearningPathway::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPathwayFlow extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_pathway_id',
        'step_no',
        'sector_id',
        'step_title',
        'description',
        'skills_text',
    ];

    public function learningPathway()
    {
        return $this->belongsTo(LearningPathway::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}

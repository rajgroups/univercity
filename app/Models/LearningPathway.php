<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPathway extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'primary_sector_id',
        'learning_outcomes',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function primarySector()
    {
        return $this->belongsTo(Sector::class, 'primary_sector_id');
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'learning_pathway_sectors')
                    ->withPivot('display_order')
                    ->orderBy('pivot_display_order');
    }

    public function flows()
    {
        return $this->hasMany(LearningPathwayFlow::class)->orderBy('step_no');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'learning_pathway_courses')
                    ->withPivot('display_order', 'is_featured')
                    ->orderBy('pivot_display_order');
    }

    public function roadmaps()
    {
        return $this->hasMany(LearningPathwayRoadmap::class)->orderBy('step_no');
    }
}

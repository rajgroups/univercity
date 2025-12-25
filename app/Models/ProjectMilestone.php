<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{
    use HasFactory;

    protected $table = 'project_milestones';

    protected $fillable = [
        'project_id',
        'stakeholder_id',
        'phase',
        'task_name',
        'planned_start_date',
        'planned_end_date',
        'in_charge',
        'priority',
        'status',
        'progress',
        'notes',
    ];

    protected $casts = [
        'planned_start_date' => 'date',
        'planned_end_date'   => 'date',
        'progress'           => 'integer',
    ];

    /* ===========================
       Relationships
    ============================ */

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }
}

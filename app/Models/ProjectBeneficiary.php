<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBeneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'type', // 'group' or 'individual'
        'category',
        'target_number',
        'reached_number',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function updates()
    {
        return $this->hasMany(ProjectBeneficiaryUpdate::class)->orderBy('date', 'asc');
    }
}

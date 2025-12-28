<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'email',
        'role',
        'survey_date',
        'satisfaction',
        'project_success',
        'comments'
    ];

    /**
     * Get the project that owns the survey.
     */
    public function project()
    {
        return $this->belongsTo(Project::class); // Make sure Project model is imported if nspace differs, but usually same namespace
    }
}

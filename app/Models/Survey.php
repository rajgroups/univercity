<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    use HasFactory;

    protected $table = 'scrutiny';

    protected $fillable = [
        'project_id', 'title', 'description', 'slug', 'is_active'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class, 'survey_id')->orderBy('order');
    }

    public function responses()
    {
        return $this->hasMany(SurveyResponse::class, 'survey_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sector_id',
        'short_name',
        'image',
        'duration',
        'paid_type',
        'short_description',
        'long_description',
        'provider',
        'language',
        'certification_type',
        'assessment_mode',
        'qp_code',
        'nsqf_level',
        'credits_assigned',
        'learning_product_type',
        'program_by',
        'initiative_of',
        'program',
        'domain',
        'occupations',
        'required_age',
        'minimum_education',
        'industry_experience',
        'learning_tools',
        'topics',
        'is_featured',
        'status',
        'start_date',
        'end_date',
        'enrollment_count',
    ];

    protected $casts = [
        'topics' => 'array', // JSON field
        'is_featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Optional: Add slug route key if needed
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class,'sector_id');
    }

}

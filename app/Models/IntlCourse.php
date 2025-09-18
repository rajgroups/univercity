<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntlCourse extends Model
{
    use HasFactory;

    protected $table = 'intlcourse';

    protected $fillable = [
        'sector_id',
        'country_id',
        'category_id',
        'name',
        'slug',
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
        'internship',
        'visa_proccess',
        'other_info',
    ];

    /**
     * Relationships
     */

    protected $casts = [
        'topics' => 'array', // JSON field
        'is_featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // A course belongs to one sector
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    // A course belongs to one country
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // A course belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

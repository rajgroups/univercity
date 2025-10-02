<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntlCourse extends Model
{
    use HasFactory;

    protected $table = 'intlcourse';

    protected $fillable = [
        // Provider & Affiliation Details
        'admin_provider',
        'partner',
        'accreditation_recognition',

        // Course Details
        'course_name',
        'level',
        'slug',
        'image',
        'sector_id',
        'category_id',
        'pathway_type',
        'country_id',
        'language_instruction',
        'learning_product_type',
        'paid_type',
        'short_description',
        'long_description',

        // Additional Course Details
        'certification_type',
        'isico_course_code',
        'international_mapping',
        'credits_transferable',
        'max_credits',
        'internship',

        // Delivery & Assessment
        'provider',
        'assessment_mode',
        'learning_tools',
        'bridge_modules',

        // Eligibility Details
        'required_age',
        'minimum_education',
        'industry_experience',
        'language_proficiency_requirement',
        'visa_proccess',
        'other_info',

        // QP & NSQF & Credit
        'qp_code',
        'nsqf_level',
        'credits_assigned',
        'program_by',
        'initiative_of',
        'program',
        'occupations',

        // Topics
        'topics',

        // Logistics & Costs
        'duration_local',
        'duration_overseas',
        'total_duration',
        'fee_structure',
        'scholarship_funding',
        'accommodation_cost',

        // Pathway & Outcomes
        'next_degree',
        'career_outcomes',
        'international_recognition',
        'pathway_next_courses',

        // Dates & Status
        'start_date',
        'end_date',
        'is_featured',
        'status',
        'enrollment_count',
    ];

    protected $casts = [
        'topics' => 'array',
        'career_outcomes' => 'array',
        'is_featured' => 'boolean',
        'status' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'enrollment_count' => 'integer',
        'max_credits' => 'integer',
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

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
    }
}

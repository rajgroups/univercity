<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class IntlCourse extends Model
{
    use HasFactory;

    protected $table = 'intlcourses';

    protected $fillable = [
        'admission_provider',
        'overseas_partner_institution',
        'accreditation_recognition',
        'country_id',
        'course_code',
        'course_title',
        'slug',
        'sector_id',
        'category_id',
        'certification_type',
        'language_of_instruction',
        'course_details',
        'topics_syllabus',
        'pathway_type',
        'mode_of_study',
        'intake_months',
        'minimum_education',
        'minimum_age',
        'work_experience_required',
        'work_experience_details',
        'language_proficiency',
        'course_duration_overseas',
        'internship_included',
        'internship_duration',
        'internship_summary',
        'local_training',
        'local_training_duration',
        'total_duration',
        'paid_type',
        'overseas_fee_breakdown',
        'local_training_fee',
        'total_fees',
        'scholarship_available',
        'scholarship_notes',
        'bank_loan_assistance',
        'loan_assistance_notes',
        'career_outcomes',
        'next_pathways',
        'visa_support_included',
        'visa_notes',
        'accommodation_support',
        'accommodation_notes',
        'living_costs',
        'faqs',
        'gallery_images',
        'thumbnail_image',
        'course_brochures',
        'short_description',
        'meta_description',
        'seo_keywords',
        'display_order',
        'publish_status',
    ];

    protected $casts = [
        'language_of_instruction' => 'array',
        'topics_syllabus' => 'array',
        'mode_of_study' => 'array',
        'intake_months' => 'array',
        'work_experience_required' => 'boolean',
        'internship_included' => 'boolean',
        'local_training' => 'boolean',
        'overseas_fee_breakdown' => 'array',
        'local_training_fee' => 'array',
        'scholarship_available' => 'boolean',
        'bank_loan_assistance' => 'boolean',
        'career_outcomes' => 'array',
        'next_pathways' => 'array',
        'visa_support_included' => 'boolean',
        'accommodation_support' => 'boolean',
        'living_costs' => 'array',
        'faqs' => 'array',
        'gallery_images' => 'array',
        'course_brochures' => 'array',
        'publish_status' => 'boolean',
    ];

    /**
     * Relationship with Sector
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * Relationship with Country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Relationship with Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Automatically generate slug when course title is set
     */
    public function setCourseTitleAttribute($value)
    {
        $this->attributes['course_title'] = $value;
        if (!array_key_exists('slug', $this->attributes) || empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    /**
     * Automatically generate course code if not provided
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->course_code)) {
                $countryCode = $model->country ? Str::upper(Str::substr($model->country->name, 0, 2)) : 'IN';
                $baseCode = $countryCode . '001';
                $counter = 1;

                while (static::where('course_code', $baseCode)->exists()) {
                    $counter++;
                    $baseCode = $countryCode . str_pad($counter, 3, '0', STR_PAD_LEFT);
                }

                $model->course_code = $baseCode;
            }
        });
    }
}

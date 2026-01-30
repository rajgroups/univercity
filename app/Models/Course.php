<?php

namespace App\Models;

use App\Enums\DurationUnit;
use App\Enums\ModeOfStudy;
use App\Enums\PaidType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_id',
        'name',
        'slug',
        'level',
        'image',
        'gallery',
        'duration_number',
        'duration_unit',
        'paid_type',
        'short_description',
        'long_description',
        'provider',
        'language',
        'certification_type',
        'assessment_mode',
        'course_code',
        'nsqf_level',
        'location',
        'mode_of_study',
        'program_by',
        'initiative_of',
        'internship',
        'domain',
        'occupations',
        'required_age',
        'minimum_education',
        'industry_experience_years',
        'industry_experience_desc',
        'learning_tools',
        'topics',
        'other_specifications',
        'is_featured',
        'status',
        'start_date',
        'end_date',
        'enrollment_count',
        'availability_status',
        'review_stars',
        'review_count',
        'internship_note',
    ];

    protected $casts = [
        'gallery' => 'array',
        'location' => 'array',
        'topics' => 'array',
        'other_specifications' => 'array',
        'internship' => 'boolean',
        'is_featured' => 'boolean',
        'status' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'industry_experience_years' => 'integer',
        'enrollment_count' => 'integer',
        'duration_number' => 'integer',
        'duration_unit' => DurationUnit::class,
        'mode_of_study' => ModeOfStudy::class,
        'paid_type' => PaidType::class,
    ];

    /**
     * Relationship with Sector
     */
    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }
    /**
     * Get mode of study text using enum
     */
    public function getModeOfStudyTextAttribute(): string
    {
        return $this->mode_of_study?->label() ?? 'Unknown';
    }

    /**
     * Get mode of study description
     */
    public function getModeOfStudyDescriptionAttribute(): string
    {
        return $this->mode_of_study?->description() ?? 'No description available';
    }

    /**
     * Get mode of study icon
     */
    public function getModeOfStudyIconAttribute(): string
    {
        return $this->mode_of_study?->icon() ?? '❓';
    }

    /**
     * Get paid type text using enum
     */
    public function getPaidTypeTextAttribute(): string
    {
        return $this->paid_type?->label() ?? 'Unknown';
    }

    /**
     * Scope for online courses
     */
    public function scopeOnline($query)
    {
        return $query->where('mode_of_study', ModeOfStudy::ONLINE->value);
    }

    /**
     * Scope for in-centre courses
     */
    public function scopeInCentre($query)
    {
        return $query->where('mode_of_study', ModeOfStudy::IN_CENTRE->value);
    }

    /**
     * Scope for hybrid courses
     */
    public function scopeHybrid($query)
    {
        return $query->where('mode_of_study', ModeOfStudy::HYBRID->value);
    }

    /**
     * Scope for on-demand courses
     */
    public function scopeOnDemand($query)
    {
        return $query->where('mode_of_study', ModeOfStudy::ON_DEMAND->value);
    }

    /**
     * Check if course is online
     */
    public function getIsOnlineAttribute(): bool
    {
        return $this->mode_of_study === ModeOfStudy::ONLINE;
    }

    /**
     * Check if course is in-centre
     */
    public function getIsInCentreAttribute(): bool
    {
        return $this->mode_of_study === ModeOfStudy::IN_CENTRE;
    }

    /**
     * Check if course is hybrid
     */
    public function getIsHybridAttribute(): bool
    {
        return $this->mode_of_study === ModeOfStudy::HYBRID;
    }

    /**
     * Check if course is on-demand
     */
    public function getIsOnDemandAttribute(): bool
    {
        return $this->mode_of_study === ModeOfStudy::ON_DEMAND;
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurationAttribute(): string
    {
        if ($this->duration_number && $this->duration_unit) {
            $unit = $this->duration_unit->value;
            $number = $this->duration_number;

            return $number . ' ' . ($number > 1 ? str($unit)->plural() : $unit);
        }

        return 'Not specified';
    }

    /**
     * Scope for courses by duration
     */
    public function scopeByDuration($query, $number, $unit)
    {
        return $query->where('duration_number', $number)
                    ->where('duration_unit', $unit);
    }

    /**
     * Scope for courses with duration greater than
     */
    public function scopeDurationGreaterThan($query, $number, $unit)
    {
        return $query->where(function($q) use ($number, $unit) {
            $q->where('duration_unit', $unit)
              ->where('duration_number', '>', $number);
        })->orWhere(function($q) use ($unit) {
            // Handle cases where unit is larger (e.g., months vs weeks)
            $largerUnits = [
                'days' => ['weeks', 'months', 'years'],
                'weeks' => ['months', 'years'],
                'months' => ['years']
            ];

            if (isset($largerUnits[$unit])) {
                $q->whereIn('duration_unit', $largerUnits[$unit]);
            }
        });
    }
}

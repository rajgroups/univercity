<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_code', 'location_type', 'title', 'subtitle', 'slug', 'category_id',
        'short_description', 'description', 'banner_images', 'thumbnail_image',
        'planned_start_date', 'planned_end_date', 'stage', 'status',

        // Location Details
        'target_location_type', 'pincode', 'state', 'district', 'taluk', 'panchayat',
        'building_name', 'gps_coordinates', 'multiple_locations', 'location_summary',
        'show_map_preview',

        // Strategic Goals
        'problem_statement', 'baseline_survey', 'donut_metrics', 'target_groups',
        'objectives', 'expected_outcomes', 'impact_image', 'scalability_notes',
        'alignment_categories', 'sdg_goals', 'govt_schemes', 'alignment_notes',
        'sustainability_plan',

        // CSR & Stakeholders
        'csr_invitation', 'cta_button_text', 'stakeholders',

        // Resources & Risks
        'resources_needed', 'compliance_requirements', 'risks',

        // Ongoing Stage
        'last_update_summary', 'project_progress', 'actual_beneficiary_count',
        'challenges_identified', 'resources_needed_ongoing', 'operational_risks_ongoing',
        'compliance_requirement_status', 'solutions_actions_taken',
        'completion_readiness', 'handover_sustainability_note',
        'actual_start_date', 'actual_end_date',

        // Media and Documents
        'gallery_images', 'before_photo', 'expected_photo', 'documents', 'links'
    ];

    protected $casts = [
        'planned_start_date' => 'date',
        'planned_end_date' => 'date',
        'actual_start_date' => 'date',
        'actual_end_date' => 'date',
        'show_map_preview' => 'boolean',
        'project_progress' => 'decimal:2',
        'completion_readiness' => 'decimal:2',
        'target_groups' => 'array',
        'sdg_goals' => 'array',
        'objectives' => 'array',
        'stakeholders' => 'array',
        'alignment_categories' => 'array',
        'govt_schemes' => 'array',
        'risks' => 'array',
        'multiple_locations' => 'array',
        // 'banner_images' => 'array',
        'gallery_images' => 'array',
        'donut_metrics' => 'array',
        'documents' => 'array',
        'links' => 'array',
        'risks' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    public function milestones()
    {
        return $this->hasMany(ProjectMilestone::class);
    }

    public function estimation()
    {
        return $this->hasOne(ProjectEstimation::class);
    }

    public function donors()
    {
        return $this->hasMany(ProjectDonor::class);
    }

    public function fundings()
    {
        return $this->hasMany(ProjectFunding::class);
    }

    public function utilizations()
    {
        return $this->hasMany(ProjectUtilization::class);
    }

    // Accessor for funding progress
    public function getFundingProgressAttribute()
    {
        if ($this->funding_target > 0) {
            return round(($this->amount_raised / $this->funding_target) * 100, 2);
        }
        return 0;
    }

    public function getBannerImagesAttribute($value)
    {
        return $value ? trim((string) $value) : null;
    }


    public function getLinksAttribute($value)
    {
        // Already an array → return as is
        if (is_array($value)) {
            return $value;
        }

        // Try JSON decode
        $decoded = json_decode($value, true);

        // If decode works → return array
        if (is_array($decoded)) {
            return $decoded;
        }

        // If value is "[]" or null → return empty array
        return [];
    }

    public function getRisksAttribute($value)
    {
        // Already an array → return
        if (is_array($value)) {
            return $value;
        }

        // Attempt JSON decode
        $decoded = json_decode($value, true);

        // If decoded correctly → return array
        if (is_array($decoded)) {
            return $decoded;
        }

        // Fallback → return empty array
        return [];
    }

    public function getDocumentsAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : [];
    }

    public function getAlignmentCategoriesAttribute($value)
    {
        if ($value === null) {
            return [];
        }

        // Step 1 — if already array, return
        if (is_array($value)) {
            return $value;
        }

        // Step 2 — first decode
        $decoded = json_decode($value, true);

        // Step 3 — handle double-encoded JSON
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        // Step 4 — final validation
        return is_array($decoded) ? $decoded : [];
    }


    public function getGovtSchemesAttribute($value)
    {
        // Already an array → return as is
        if (is_array($value)) {
            return $value;
        }

        // Try JSON decode
        $decoded = json_decode($value, true);

        // If decode works → return array
        if (is_array($decoded)) {
            return $decoded;
        }

        // If value is "[]" or null → return empty array
        return [];
    }

    public function getDonutMetricsAttribute($value)
    {
        if ($value === null) {
            return [];
        }

        // Already array → return
        if (is_array($value)) {
            return $value;
        }

        // 1st decode
        $decoded = json_decode($value, true);

        // Handle double-encoded case
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        // Ensure final output is array
        return is_array($decoded) ? $decoded : [];
    }

    public function getTargetGroupsAttribute($value)
    {
        if ($value === null) {
            return [];
        }

        // If already array, return as-is
        if (is_array($value)) {
            return $value;
        }

        // First decode
        $decoded = json_decode($value, true);

        // Handle cases like "\"[{...}]\""
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        return is_array($decoded) ? $decoded : [];
    }


    public function getGalleryImagesAttribute($value)
    {
        // If null or empty → return empty array
        if ($value === null || $value === '' || $value === '[]' || $value === '"[]"') {
            return [];
        }

        // Already an array → filter and return
        if (is_array($value)) {
            return array_values(array_filter($value, function($item) {
                // Filter out invalid entries
                return !empty($item) && $item !== '[]' && $item !== '"[]"' && is_string($item) && strlen(trim($item)) > 0;
            }));
        }

        // Try JSON decode
        $decoded = json_decode($value, true);

        // If JSON decodes to an array → filter and return
        if (is_array($decoded)) {
            return array_values(array_filter($decoded, function($item) {
                // Filter out invalid entries
                return !empty($item) && $item !== '[]' && $item !== '"[]"' && is_string($item) && strlen(trim($item)) > 0;
            }));
        }

        // If it's a valid single image string → wrap into array
        if (is_string($value) && strlen(trim($value)) > 0 && $value !== '[]' && $value !== '"[]"') {
            return [$value];
        }

        return [];
    }

    public function getSdgGoalsAttribute($value)
    {
        if ($value === null) {
            return [];
        }

        // First decode
        $decoded = is_array($value) ? $value : json_decode($value, true);

        // Handle double-encoded case like "\"[1,2,3,4]\""
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Validate an SDG value entry
     */
    protected function isValidSdgValue($value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        $value = trim($value);

        return $value !== ''
            && $value !== '[]'
            && $value !== '"[]"';
    }

}

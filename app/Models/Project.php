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
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor for funding progress
    public function getFundingProgressAttribute()
    {
        if ($this->funding_target > 0) {
            return round(($this->amount_raised / $this->funding_target) * 100, 2);
        }
        return 0;
    }
}

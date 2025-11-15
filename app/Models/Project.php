<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_code', 'title', 'slug', 'subtitle', 'category_id', 'short_description',
        'description', 'image', 'banner_image', 'stage', 'status', 'type', 'cost',
        'start_date', 'end_date', 'beneficiaries', 'funding_type', 'csr_partner_type',
        'csr_invitation', 'crowdfunding_status', 'cta_button_text', 'interest_link',
        'project_lead', 'actual_start_date', 'expected_end_date', 'ongoing_beneficiaries',
        'project_cost', 'funding_target', 'amount_raised', 'ongoing_crowdfunding_status',
        'main_donor', 'isico_message', 'progress_updates', 'completed_project_lead',
        'completed_start_date', 'completed_end_date', 'final_cost', 'completed_beneficiaries',
        'completed_csr_partner', 'impact_summary', 'outcome_metrics', 'testimonials',
        'sustainability_plan', 'lessons_learned', 'completion_report', 'utilization_certificate',
        'impact_stories', 'points', 'sdgs', 'gallery', 'before_after_images'
    ];

    protected $casts = [
        'status' => 'boolean',
        'cost' => 'decimal:2',
        'project_cost' => 'decimal:2',
        'funding_target' => 'decimal:2',
        'amount_raised' => 'decimal:2',
        'final_cost' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'actual_start_date' => 'date',
        'expected_end_date' => 'date',
        'completed_start_date' => 'date',
        'completed_end_date' => 'date',
        'beneficiaries' => 'array',
        'points' => 'array',
        'sdgs' => 'array',
        'gallery' => 'array',
        'before_after_images' => 'array',
        'progress_updates' => 'array',
        'outcome_metrics' => 'array',
        'testimonials' => 'array',
        'impact_stories' => 'array',
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

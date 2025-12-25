<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stakeholder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stakeholder_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'alternate_phone',
        'company_name',
        'designation',
        'department',
        'type',
        'category',
        'communication_preferences',
        'preferred_language',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'country',
        'postal_code',
        'industry',
        'expertise_area',
        'biography',
        'linkedin_url',
        'twitter_url',
        'website_url',
        'engagement_level',
        'influence_level',
        'interest_level',
        'assigned_projects',
        'involved_phases',
        'status',
        'last_contacted',
        'next_follow_up',
        'metadata',
        'notes'
    ];

    protected $casts = [
        'communication_preferences' => 'array',
        'assigned_projects' => 'array',
        'involved_phases' => 'array',
        'metadata' => 'array',
        'last_contacted' => 'date',
        'next_follow_up' => 'date',
        'engagement_level' => 'integer'
    ];

    protected $appends = ['full_name'];

    /**
     * Get the full name attribute.
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Generate a unique stakeholder ID.
     */
    public static function generateStakeholderId(): string
    {
        $latest = self::withTrashed()
            ->where('stakeholder_id', 'like', 'STKH-%')
            ->orderBy('id', 'desc')
            ->first();

        if ($latest && preg_match('/STKH-(\d+)/', $latest->stakeholder_id, $matches)) {
            $number = (int) $matches[1] + 1;
        } else {
            $number = 1;
        }

        return 'STKH-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Boot method for generating stakeholder ID.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stakeholder) {
            if (empty($stakeholder->stakeholder_id)) {
                $stakeholder->stakeholder_id = self::generateStakeholderId();
            }
        });
    }

    /**
     * Relationship with projects.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'stakeholder_project')
            ->withPivot('role', 'access_level', 'assigned_phases', 'involvement_percentage', 'start_date', 'end_date', 'is_active', 'notes')
            ->withTimestamps();
    }

    /**
     * Relationship with communications.
     */
    public function communications()
    {
        return $this->hasMany(StakeholderCommunication::class);
    }

    /**
     * Relationship with feedbacks.
     */
    public function feedbacks()
    {
        return $this->hasMany(StakeholderFeedback::class);
    }

    /**
     * Scope for active stakeholders.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for stakeholders by type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope for stakeholders by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope for stakeholders involved in a project.
     */
    public function scopeInProject($query, $projectId)
    {
        return $query->whereJsonContains('assigned_projects', $projectId)
            ->orWhereHas('projects', function ($q) use ($projectId) {
                $q->where('project_id', $projectId);
            });
    }

    /**
     * Get stakeholders by influence level.
     */
    public function scopeWithInfluenceLevel($query, $level)
    {
        return $query->where('influence_level', $level);
    }

    /**
     * Get stakeholders needing follow-up.
     */
    public function scopeNeedsFollowUp($query)
    {
        return $query->whereNotNull('next_follow_up')
            ->where('next_follow_up', '<=', now()->addDays(7))
            ->where('status', 'active');
    }
}

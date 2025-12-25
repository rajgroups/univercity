<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StakeholderFeedback extends Model
{
    protected $fillable = [
        'stakeholder_id',
        'project_id',
        'feedback_by',
        'feedback_type',
        'rating',
        'comments',
        'aspects',
        'sentiment',
        'is_anonymous',
        'action_required',
        'action_taken',
        'action_completed_at'
    ];

    protected $casts = [
        'aspects' => 'array',
        'is_anonymous' => 'boolean',
        'action_required' => 'boolean',
        'action_completed_at' => 'datetime',
        'rating' => 'integer'
    ];

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function feedbackBy()
    {
        return $this->belongsTo(User::class, 'feedback_by');
    }
}

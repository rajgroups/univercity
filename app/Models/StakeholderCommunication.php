<?php
// app/Models/StakeholderCommunication.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StakeholderCommunication extends Model
{
    protected $fillable = [
        'stakeholder_id',
        'project_id',
        'communicator_id',
        'communication_type',
        'subject',
        'message',
        'attachments',
        'direction',
        'priority',
        'requires_response',
        'response_due_date',
        'response_received',
        'response_received_at',
        'status',
        'satisfaction_score',
        'feedback',
        'sent_at',
        'read_at'
    ];

    protected $casts = [
        'attachments' => 'array',
        'requires_response' => 'boolean',
        'response_received' => 'boolean',
        'response_due_date' => 'datetime',
        'response_received_at' => 'datetime',
        'sent_at' => 'datetime',
        'read_at' => 'datetime',
        'satisfaction_score' => 'integer'
    ];

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function communicator()
    {
        return $this->belongsTo(User::class, 'communicator_id');
    }
}

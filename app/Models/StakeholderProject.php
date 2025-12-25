<?php
// app/Models/StakeholderProject.php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StakeholderProject extends Pivot
{
    protected $table = 'stakeholder_project';

    protected $casts = [
        'assigned_phases' => 'array',
        'involvement_percentage' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBeneficiaryUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_beneficiary_id',
        'reached_number',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(ProjectBeneficiary::class, 'project_beneficiary_id');
    }
}

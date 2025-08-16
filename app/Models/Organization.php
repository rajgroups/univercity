<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name',
        'organization_type',
        'website',
        'contact_name',
        'contact_designation',
        'contact_number',
        'contact_email',
        'address',
        'country',
        'state',
        'district',
        'city_village',
        'pincode',
        'collaboration',
        'beneficiary'
    ];
    
    // Optionally add constants for the dropdown values
    const ORG_TYPES = [
        'Institution',
        'Industry',
        'International Collaboration',
        'CSR',
        'NGO'
    ];
    
    const COLLABORATION_TYPES = [
        'Skill Training',
        'Internship',
        'Placement',
        'Funding',
        'Curriculum Development',
        'International Exchange',
        'Infrastructure Support',
        'CSR Support',
        'Project Support',
        'Volunteers',
        'Research',
        'Others'
    ];
    
    const BENEFICIARY_TYPES = [
        'School',
        'College',
        'Women SHG',
        'Rural Youth',
        'Others'
    ];
}

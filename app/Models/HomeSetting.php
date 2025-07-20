<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;

    protected $table = "homesetting";

    protected $fillable = [
        'about_main_title',
        'about_sub_title',
        'about_title',
        'about_description',
        'operate_main_title',
        'operate_sub_title',
        'operate_sections',
        'on_going_project_title',
        'on_going_project_main_title',
        'on_going_project_main_sub_title',
        'onging_final_title',
        'upcoming_project_title',
        'upcoming_project_main_title',
        'upcoming_project_main_sub_title',
        'upcoming_final_title',
        'upcoming_secondary_title',
        'upcoming_secondary_desc',
        'program_project_title',
        'program_project_main_title',
        'program_project_main_sub_title',
        'program_final_title',
        'core_title_one',
        'core_title_two',
        'core_image',
        'focus_main_title',
        'focus_areas',
        'founder_message',
        'founder_name',
        'future_goals',
        'collaboration_main_title',
        'collaboration_sub_title',
        'international_collaborations',

        // Newly added government scheme fields
        'gvt_scheme_title',
        'gvt_scheme_main_title',
        'gvt_scheme_main_sub_title',
        'gvt_scheme_final_title',
    ];


    protected $casts = [
        'operate_sections'             => 'array',
        'focus_areas'                  => 'array',
        'future_goals'                 => 'array',
        'international_collaborations' => 'array',
    ];
}

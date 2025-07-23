<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('homesetting')->insert([
            // About Section
            'about_main_title'     => 'Welcome to Our Organization',
            'about_sub_title'      => 'Empowering Communities',
            'about_title'          => 'Empowering People through Knowledge',
            'about_description'    => 'We believe in creating change through education, innovation, and collaboration.',

            // Operate Section
            'operate_main_title'   => 'How We Operate',
            'operate_sub_title'    => 'Our Learning Approach',
            'operate_sections'     => json_encode([
                [
                    'operate_title' => 'Research Driven',
                    'operate_desc'  => 'We rely on data and research to guide our actions.',
                    'operate_icon'  => 'icons/research.png'
                ],
                [
                    'operate_title' => 'Community Centric',
                    'operate_desc'  => 'Our projects are designed for and by the community.',
                    'operate_icon'  => 'icons/community.png'
                ]
            ]),

            // Ongoing Section
            'on_going_project_title'         => 'Ongoing Projects',
            'on_going_project_main_title'    => 'Making a Difference',
            'on_going_project_main_sub_title'=> 'Projects in Action',
            'onging_final_title'             => 'Continue Supporting Us',

            // Upcoming Section
            'upcoming_project_title'         => 'Upcoming Projects',
            'upcoming_project_main_title'    => 'Shaping Tomorrow',
            'upcoming_project_main_sub_title'=> 'Ideas in the Pipeline',
            'upcoming_final_title'           => 'Stay Tuned',
            'upcoming_secondary_title'       => 'The Future is Bright',
            'upcoming_secondary_desc'        => 'We are working on innovative solutions to global challenges.',

            // Program Section
            'program_project_title'          => 'Our Programs',
            'program_project_main_title'     => 'Programs for Growth',
            'program_project_main_sub_title' => 'Empowering Through Action',
            'program_final_title'            => 'Join Our Programs',

            // Core Values
            'core_title_one'                 => 'Integrity',
            'core_title_two'                 => 'Innovation',
            'core_image'                     => 'images/core-values.png',

            // Program Section
            'gvt_scheme_title'               => 'Our Programs',
            'gvt_scheme_main_title'          => 'Programs for Growth',
            'gvt_scheme_main_sub_title'      => 'Empowering Through Action',
            'gvt_scheme_final_title'         => 'Join Our Programs',

            // Focus Areas
            'focus_main_title'              => 'Key Areas of Focus',
            'focus_areas'                   => json_encode([
                [
                    'focus_title'       => 'Education Reform',
                    'focus_description'=> 'Transforming education through policy and technology.'
                ],
                [
                    'focus_title'       => 'Healthcare Access',
                    'focus_description'=> 'Improving access to essential medical services.'
                ]
            ]),

            // Founder Message
            'founder_message'               => 'Thank you for being part of our mission to build a better world.',
            'founder_name'                  => 'Dr. A. P. Founder',

            // Future Goals
            'future_goals'                 => json_encode([
                [
                    'goal_title'       => 'Expand to 10 Countries',
                    'goal_description' => 'Reach underserved communities across the globe.'
                ],
                [
                    'goal_title'       => 'Launch Global Fellowship',
                    'goal_description' => 'Support young leaders making change.'
                ]
            ]),

            // International Collaboration
            'collaboration_main_title'      => 'Global Partnerships',
            'collaboration_sub_title'       => 'Collaborate Across Borders',
            'international_collaborations'  => json_encode([
                [
                    'collaboration_ques' => 'Why international partners?',
                    'collaboration_ans'  => 'They help scale impact and bring diverse expertise.',
                    'collaboration_icon' => 'icons/partner1.png'
                ],
                [
                    'collaboration_ques' => 'How to join?',
                    'collaboration_ans'  => 'Reach out via our contact form for collaborations.',
                    'collaboration_icon' => 'icons/partner2.png'
                ]
            ]),
            'status'     => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

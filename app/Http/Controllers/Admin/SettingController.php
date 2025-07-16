<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function editHomePage(){
        return view('admin.settings.home');
    }
    /*
         * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules());

        // Handle image uploads
        $coreImagePath = null;
        if ($request->hasFile('core_image')) {
            $coreImagePath = $request->file('core_image')->store('projects/core_images', 'public');
        }

        // Process dynamic sections for JSON storage
        $operateSections = [];
        if ($request->has('operate_title')) {
            foreach ($request->operate_title as $key => $title) {
                $operateIconPath = null;
                if ($request->hasFile('operate_icon.' . $key)) {
                    $operateIconPath = $request->file('operate_icon.' . $key)->store('projects/operate_icons', 'public');
                }
                $operateSections[] = [
                    'title' => $title,
                    'description' => $request->operate_desc[$key] ?? null,
                    'icon' => $operateIconPath,
                ];
            }
        }

        $focusAreas = [];
        if ($request->has('focus_title')) {
            foreach ($request->focus_title as $key => $title) {
                $focusAreas[] = [
                    'title' => $title,
                    'description' => $request->focus_description[$key] ?? null,
                ];
            }
        }

        $futureGoals = [];
        if ($request->has('goal_title')) {
            foreach ($request->goal_title as $key => $title) {
                $futureGoals[] = [
                    'title' => $title,
                    'description' => $request->goal_description[$key] ?? null,
                ];
            }
        }

        $internationalCollaborations = [];
        if ($request->has('collaboration_ques')) {
            foreach ($request->collaboration_ques as $key => $question) {
                $collabIconPath = null;
                if ($request->hasFile('collaboration_icon.' . $key)) {
                    $collabIconPath = $request->file('collaboration_icon.' . $key)->store('projects/collaboration_icons', 'public');
                }
                $internationalCollaborations[] = [
                    'question' => $question,
                    'answer' => $request->collaboration_ans[$key] ?? null,
                    'icon' => $collabIconPath,
                ];
            }
        }


        Project::create([
            'about_main_title'              => $validatedData['about_main_title'],
            'about_sub_title'               => $validatedData['about_sub_title'] ?? null,
            'about_title'                   => $validatedData['about_title'] ?? null, // maps to empowering_title
            'about_description'             => $validatedData['about_description'],
            'operate_main_title'            => $validatedData['operate_main_title'],
            'operate_sub_title'             => $validatedData['operate_sub_title'] ?? null,
            'operate_sections'              => $operateSections, // Stored as JSON
            'on_going_project_title'        => $validatedData['on_going_project_title'] ?? null,
            'on_going_project_main_title'   => $validatedData['on_going_project_main_title'],
            'on_going_project_main_sub_title' => $validatedData['on_going_project_main_sub_title'] ?? null,
            'onging_final_title'            => $validatedData['onging_final_title'] ?? null,
            'upcoming_project_title'        => $validatedData['upcoming_project_title'] ?? null,
            'upcoming_project_main_title'   => $validatedData['upcoming_project_main_title'],
            'upcoming_project_main_sub_title' => $validatedData['upcoming_project_main_sub_title'] ?? null,
            'upcoming_final_title'          => $validatedData['upcoming_final_title'] ?? null,
            'upcoming_secondary_title'      => $validatedData['upcoming_secondary_title'],
            'upcoming_secondary_desc'       => $validatedData['upcoming_secondary_desc'] ?? null,
            'program_project_title'         => $validatedData['program_project_title'] ?? null,
            'program_project_main_title'    => $validatedData['program_project_main_title'],
            'program_project_main_sub_title' => $validatedData['program_project_main_sub_title'] ?? null,
            'program_final_title'           => $validatedData['program_final_title'] ?? null,
            'core_title_one'                => $validatedData['core_title_one'],
            'core_title_two'                => $validatedData['core_title_two'] ?? null,
            'core_image'                    => $coreImagePath, // Stored as path
            'focus_main_title'              => $validatedData['focus_main_title'],
            'focus_areas'                   => $focusAreas, // Stored as JSON
            'founder_message'               => $validatedData['founder_message'],
            'founder_name'                  => $validatedData['founder_name'],
            'future_goals'                  => $futureGoals, // Stored as JSON
            'collaboration_main_title'      => $validatedData['collaboration_main_title'],
            'collaboration_sub_title'       => $validatedData['collaboration_sub_title'] ?? null,
            'international_collaborations'  => $internationalCollaborations, // Stored as JSON
        ]);

        return redirect()->route('admin.project.index')->with('success', 'Project created successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate($this->rules($project->id)); // Pass project ID for unique rules if any

        // Handle image uploads for update
        $coreImagePath = $project->core_image; // Keep existing path by default
        if ($request->hasFile('core_image')) {
            // Delete old image if exists
            if ($project->core_image) {
                Storage::disk('public')->delete($project->core_image);
            }
            $coreImagePath = $request->file('core_image')->store('projects/core_images', 'public');
        }

        // Process dynamic sections for JSON storage (Update logic is more complex)
        // You'll need to retrieve existing data, merge, and potentially delete old files.
        // For simplicity in this example, we'll re-process them, assuming a full replacement.
        // A more robust solution would involve diffing the arrays.

        $operateSections = [];
        if ($request->has('operate_title')) {
            foreach ($request->operate_title as $key => $title) {
                $operateIconPath = null;
                // If a new file is uploaded for this specific dynamic item
                if ($request->hasFile('operate_icon.' . $key)) {
                    $operateIconPath = $request->file('operate_icon.' . $key)->store('projects/operate_icons', 'public');
                } else {
                    // If no new file, try to retain the old one from the existing JSON data
                    // This requires fetching the old data for the specific index
                    $oldOperateData = json_decode($project->operate_sections, true);
                    if (isset($oldOperateData[$key]['icon'])) {
                         $operateIconPath = $oldOperateData[$key]['icon'];
                    }
                }
                $operateSections[] = [
                    'title' => $title,
                    'description' => $request->operate_desc[$key] ?? null,
                    'icon' => $operateIconPath,
                ];
            }
        }


        $focusAreas = [];
        if ($request->has('focus_title')) {
            foreach ($request->focus_title as $key => $title) {
                $focusAreas[] = [
                    'title' => $title,
                    'description' => $request->focus_description[$key] ?? null,
                ];
            }
        }

        $futureGoals = [];
        if ($request->has('goal_title')) {
            foreach ($request->goal_title as $key => $title) {
                $futureGoals[] = [
                    'title' => $title,
                    'description' => $request->goal_description[$key] ?? null,
                ];
            }
        }

        $internationalCollaborations = [];
        if ($request->has('collaboration_ques')) {
            foreach ($request->collaboration_ques as $key => $question) {
                $collabIconPath = null;
                if ($request->hasFile('collaboration_icon.' . $key)) {
                    $collabIconPath = $request->file('collaboration_icon.' . $key)->store('projects/collaboration_icons', 'public');
                } else {
                     // Retain old if no new file is uploaded
                    $oldCollabData = json_decode($project->international_collaborations, true);
                    if (isset($oldCollabData[$key]['icon'])) {
                         $collabIconPath = $oldCollabData[$key]['icon'];
                    }
                }
                $internationalCollaborations[] = [
                    'question' => $question,
                    'answer' => $request->collaboration_ans[$key] ?? null,
                    'icon' => $collabIconPath,
                ];
            }
        }


        $project->update([
            'about_main_title'              => $validatedData['about_main_title'],
            'about_sub_title'               => $validatedData['about_sub_title'] ?? null,
            'about_title'                   => $validatedData['about_title'] ?? null,
            'about_description'             => $validatedData['about_description'],
            'operate_main_title'            => $validatedData['operate_main_title'],
            'operate_sub_title'             => $validatedData['operate_sub_title'] ?? null,
            'operate_sections'              => $operateSections,
            'on_going_project_title'        => $validatedData['on_going_project_title'] ?? null,
            'on_going_project_main_title'   => $validatedData['on_going_project_main_title'],
            'on_going_project_main_sub_title' => $validatedData['on_going_project_main_sub_title'] ?? null,
            'onging_final_title'            => $validatedData['onging_final_title'] ?? null,
            'upcoming_project_title'        => $validatedData['upcoming_project_title'] ?? null,
            'upcoming_project_main_title'   => $validatedData['upcoming_project_main_title'],
            'upcoming_project_main_sub_title' => $validatedData['upcoming_project_main_sub_title'] ?? null,
            'upcoming_final_title'          => $validatedData['upcoming_final_title'] ?? null,
            'upcoming_secondary_title'      => $validatedData['upcoming_secondary_title'],
            'upcoming_secondary_desc'       => $validatedData['upcoming_secondary_desc'] ?? null,
            'program_project_title'         => $validatedData['program_project_title'] ?? null,
            'program_project_main_title'    => $validatedData['program_project_main_title'],
            'program_project_main_sub_title' => $validatedData['program_project_main_sub_title'] ?? null,
            'program_final_title'           => $validatedData['program_final_title'] ?? null,
            'core_title_one'                => $validatedData['core_title_one'],
            'core_title_two'                => $validatedData['core_title_two'] ?? null,
            'core_image'                    => $coreImagePath,
            'focus_main_title'              => $validatedData['focus_main_title'],
            'focus_areas'                   => $focusAreas,
            'founder_message'               => $validatedData['founder_message'],
            'founder_name'                  => $validatedData['founder_name'],
            'future_goals'                  => $futureGoals,
            'collaboration_main_title'      => $validatedData['collaboration_main_title'],
            'collaboration_sub_title'       => $validatedData['collaboration_sub_title'] ?? null,
            'international_collaborations'  => $internationalCollaborations,
        ]);

        return redirect()->route('admin.project.index')->with('success', 'Project updated successfully!');
    }


    /**
     * Define validation rules for project creation/update.
     *
     * @param int|null $projectId
     * @return array
     */
    protected function rules(?int $projectId = null): array
    {
        return [
            // About Section
            'about_main_title'          => 'required|string|max:255',
            'about_sub_title'           => 'nullable|string|max:255',
            'about_title'               => 'nullable|string|max:255', // Corresponds to empowering_title
            'about_description'         => 'required|string',

            // Operate Section
            'operate_main_title'        => 'required|string|max:255',
            'operate_sub_title'         => 'nullable|string|max:255',
            'operate_title.*'           => 'required|string|max:255', // For each dynamic input
            'operate_desc.*'            => 'required|string|max:500', // For each dynamic input
            'operate_icon.*'            => [
                Rule::when(
                    fn ($input) => !($projectId && isset($input->operate_sections[$input->__key__]['icon'])), // For update, if no old image exists
                    'required', // Required only if not updating and no existing image, or if it's new creation
                    'nullable' // Optional for existing entries if not changing image
                ),
                'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048' // Max 2MB
            ],


            // Ongoing Section
            'on_going_project_title'        => 'nullable|string|max:255',
            'on_going_project_main_title'   => 'required|string|max:255',
            'on_going_project_main_sub_title' => 'nullable|string|max:255',
            'onging_final_title'            => 'nullable|string|max:255',

            // Upcoming Section
            'upcoming_project_title'        => 'nullable|string|max:255',
            'upcoming_project_main_title'   => 'required|string|max:255',
            'upcoming_project_main_sub_title' => 'nullable|string|max:255',
            'upcoming_final_title'          => 'nullable|string|max:255',
            'upcoming_secondary_title'      => 'required|string|max:255',
            'upcoming_secondary_desc'       => 'nullable|string',

            // Program Section
            'program_project_title'         => 'nullable|string|max:255',
            'program_project_main_title'    => 'required|string|max:255',
            'program_project_main_sub_title' => 'nullable|string|max:255',
            'program_final_title'           => 'nullable|string|max:255',

            // Core Values Section
            'core_title_one'                => 'required|string|max:255',
            'core_title_two'                => 'nullable|string|max:255',
            'core_image'                    => [
                Rule::when(
                    fn ($input) => !($projectId && Project::find($projectId)->core_image), // Required if creating or if no existing image during update
                    'required',
                    'nullable' // Optional if an image already exists during update
                ),
                'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'
            ],

            // Key Areas of Focus
            'focus_main_title'          => 'required|string|max:255',
            'focus_title.*'             => 'required|string|max:255',
            'focus_description.*'       => 'required|string|max:1000',

            // Message from Founder
            'founder_message'           => 'required|string',
            'founder_name'              => 'required|string|max:255',

            // Future Goals
            'goal_title.*'              => 'required|string|max:255',
            'goal_description.*'        => 'required|string|max:1000',

            // International Collaboration
            'collaboration_main_title'  => 'required|string|max:255',
            'collaboration_sub_title'   => 'nullable|string|max:255',
            'collaboration_ques.*'      => 'required|string|max:255',
            'collaboration_ans.*'       => 'required|string|max:500',
            'collaboration_icon.*'      => [
                Rule::when(
                    fn ($input) => !($projectId && isset($input->international_collaborations[$input->__key__]['icon'])), // For update, if no old image exists
                    'required',
                    'nullable'
                ),
                'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'
            ],
        ];
    }
}

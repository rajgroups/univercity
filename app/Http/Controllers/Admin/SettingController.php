<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function editHomePage(){
        $data = HomeSetting::where('status',1)->first();
        // dd($data);
        return view('admin.settings.home',compact('data'));
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

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'about_main_title'                      => 'required|string|max:255',
            'about_sub_title'                       => 'required|string|max:255',
            'about_title'                           => 'required|string|max:255',
            'about_description'                     => 'required|string',
            'operate_main_title'                    => 'required|string|max:255',
            'operate_sub_title'                     => 'required|string|max:255',
            'on_going_project_title'                => 'required|string|max:255',
            'on_going_project_main_title'           => 'required|string|max:255',
            'on_going_project_main_sub_title'       => 'required|string|max:255',
            'onging_final_title'                    => 'required|string|max:255',
            'upcoming_project_title'                => 'required|string|max:255',
            'upcoming_project_main_title'           => 'required|string|max:255',
            'upcoming_project_main_sub_title'       => 'required|string|max:255',
            'upcoming_final_title'                  => 'required|string|max:255',
            'upcoming_secondary_title'              => 'required|string|max:255',
            'upcoming_secondary_desc'               => 'required|string',
            'program_project_title'                 => 'required|string|max:255',
            'program_project_main_title'            => 'required|string|max:255',
            'program_project_main_sub_title'        => 'required|string|max:255',
            'program_final_title'                   => 'required|string|max:255',
            'core_title_one'                        => 'required|string|max:255',
            'core_title_two'                        => 'required|string|max:255',
            'focus_main_title'                      => 'required|string|max:255',
            'founder_message'                       => 'required|string',
            'founder_name'                          => 'required|string|max:255',
            'collaboration_main_title'              => 'required|string|max:255',
            'collaboration_sub_title'               => 'required|string|max:255',
            'gvt_scheme_title'                      => 'required|string|max:255',
            'gvt_scheme_main_title'                 => 'required|string|max:255',
            'gvt_scheme_main_sub_title'             => 'required|string|max:255',
            'gvt_scheme_final_title'                => 'required|string|max:255',
            'core_image'                            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'operate_icon.*'                        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'collaboration_icon.*'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the home setting record
        $homeSetting = HomeSetting::findOrFail($id);

        // Create directory if it doesn't exist
        $publicPath = public_path('homepage/files');
        if (!File::exists($publicPath)) {
            File::makeDirectory($publicPath, 0755, true);
        }

        // Handle operate sections
        $operateSections = [];
        if ($request->has('operate_title')) {
            foreach ($request->operate_title as $index => $title) {
                $section = [
                    'operate_title' => $title,
                    'operate_desc' => $request->operate_desc[$index],
                    'operate_icon' => $request->existing_operate_icon[$index] ?? null,
                ];

                // Handle new image upload if provided
                if ($request->hasFile('operate_icon') && isset($request->file('operate_icon')[$index])) {
                    $file = $request->file('operate_icon')[$index];
                    $fileName = 'operate_icon_'.time().'_'.$index.'.'.$file->getClientOriginalExtension();
                    $file->move($publicPath, $fileName);
                    $section['operate_icon'] = 'homepage/files/'.$fileName;
                    
                    // Delete old image if it exists
                    if (!empty($request->existing_operate_icon[$index])) {
                        $oldImage = public_path($request->existing_operate_icon[$index]);
                        if (File::exists($oldImage)) {
                            File::delete($oldImage);
                        }
                    }
                }

                $operateSections[] = $section;
            }
        }

        // Handle focus areas
        $focusAreas = [];
        if ($request->has('focus_title')) {
            foreach ($request->focus_title as $index => $title) {
                $focusAreas[] = [
                    'focus_title' => $title,
                    'focus_description' => $request->focus_description[$index],
                ];
            }
        }

        // Handle future goals
        $futureGoals = [];
        if ($request->has('goal_title')) {
            foreach ($request->goal_title as $index => $title) {
                $futureGoals[] = [
                    'goal_title' => $title,
                    'goal_description' => $request->goal_description[$index],
                ];
            }
        }

        // Handle collaborations
        $collaborations = [];
        if ($request->has('collaboration_ques')) {
            foreach ($request->collaboration_ques as $index => $question) {
                $collab = [
                    'question' => $question,
                    'answer' => $request->collaboration_ans[$index],
                    'operate_icon' => $request->existing_collaboration_icon[$index] ?? null,
                ];

                // Handle new image upload if provided
                if ($request->hasFile('collaboration_icon') && isset($request->file('collaboration_icon')[$index])) {
                    $file = $request->file('collaboration_icon')[$index];
                    $fileName = 'collab_icon_'.time().'_'.$index.'.'.$file->getClientOriginalExtension();
                    $file->move($publicPath, $fileName);
                    $collab['operate_icon'] = 'homepage/files/'.$fileName;
                    
                    // Delete old image if it exists
                    if (!empty($request->existing_collaboration_icon[$index])) {
                        $oldImage = public_path($request->existing_collaboration_icon[$index]);
                        if (File::exists($oldImage)) {
                            File::delete($oldImage);
                        }
                    }
                }

                $collaborations[] = $collab;
            }
        }

        // Handle core image
        if ($request->hasFile('core_image')) {
            $file = $request->file('core_image');
            $fileName = 'core_image_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($publicPath, $fileName);
            $validated['core_image'] = 'homepage/files/'.$fileName;
            
            // Delete old image if it exists
            if ($homeSetting->core_image) {
                $oldImage = public_path($homeSetting->core_image);
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
        } elseif ($request->has('existing_core_image')) {
            $validated['core_image'] = $request->existing_core_image;
        } else {
            $validated['core_image'] = $homeSetting->core_image;
        }

        // Prepare all update data
        $updateData = [
            'about_main_title'                          => $validated['about_main_title'],
            'about_sub_title'                           => $validated['about_sub_title'],
            'about_title'                               => $validated['about_title'],
            'about_description'                         => $validated['about_description'],
            'operate_main_title'                        => $validated['operate_main_title'],
            'operate_sub_title'                         => $validated['operate_sub_title'],
            'operate_sections'                          => json_encode($operateSections),
            'on_going_project_title'                    => $validated['on_going_project_title'],
            'on_going_project_main_title'               => $validated['on_going_project_main_title'],
            'on_going_project_main_sub_title'           => $validated['on_going_project_main_sub_title'],
            'onging_final_title'                        => $validated['onging_final_title'],
            'upcoming_project_title'                    => $validated['upcoming_project_title'],
            'upcoming_project_main_title'               => $validated['upcoming_project_main_title'],
            'upcoming_project_main_sub_title'           => $validated['upcoming_project_main_sub_title'],
            'upcoming_final_title'                      => $validated['upcoming_final_title'],
            'upcoming_secondary_title'                  => $validated['upcoming_secondary_title'],
            'upcoming_secondary_desc'                   => $validated['upcoming_secondary_desc'],
            'program_project_title'                     => $validated['program_project_title'],
            'program_project_main_title'                => $validated['program_project_main_title'],
            'program_project_main_sub_title'            => $validated['program_project_main_sub_title'],
            'program_final_title'                       => $validated['program_final_title'],
            'core_title_one'                            => $validated['core_title_one'],
            'core_title_two'                            => $validated['core_title_two'],
            'core_image'                                => $validated['core_image'],
            'focus_main_title'                          => $validated['focus_main_title'],
            'focus_areas'                               => json_encode($focusAreas),
            'founder_message'                           => $validated['founder_message'],
            'founder_name'                              => $validated['founder_name'],
            'future_goals'                              => json_encode($futureGoals),
            'collaboration_main_title'                  => $validated['collaboration_main_title'],
            'collaboration_sub_title'                   => $validated['collaboration_sub_title'],
            'international_collaborations'              => json_encode($collaborations),
            'gvt_scheme_title'                          => $validated['gvt_scheme_title'],
            'gvt_scheme_main_title'                     => $validated['gvt_scheme_main_title'],
            'gvt_scheme_main_sub_title'                 => $validated['gvt_scheme_main_sub_title'],
            'gvt_scheme_final_title'                    => $validated['gvt_scheme_final_title'],
        ];

        // Update the home setting
        $homeSetting->update($updateData);

        return redirect()->back()->with('success', 'Home settings updated successfully!');
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\LearningPathway;
use App\Models\LearningPathwayFlow;
use App\Models\LearningPathwayRoadmap;
use App\Models\Project;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearningPathwayController extends Controller
{
    public function index($project_id)
    {
        $project = Project::findOrFail($project_id);
        $learningPathway = LearningPathway::where('project_id', $project_id)->first();

        // Singleton Enforcement: Redirect to Edit if exists, else Create
        if ($learningPathway) {
            return redirect()->route('admin.learningpathways.edit', ['project_id' => $project->id, 'id' => $learningPathway->id]);
        } else {
            return redirect()->route('admin.learningpathways.create', $project->id);
        }
    }

    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);
        
        // Singleton Check
        $existingPathway = LearningPathway::where('project_id', $project_id)->first();
        if ($existingPathway) {
             return redirect()->route('admin.learningpathways.edit', ['project_id' => $project->id, 'id' => $existingPathway->id]);
        }

        $sectors = Sector::all();
        $courses = Course::where('status', 1)->get(); 

        return view('admin.learningpathways.create', compact('project', 'sectors', 'courses'));
    }

    public function store(Request $request, $project_id)
    {
        $project = Project::findOrFail($project_id);

        if (LearningPathway::where('project_id', $project_id)->exists()) {
             notyf()->addError('A Learning Pathway already exists for this project.');
             return redirect()->back();
        }

        $request->validate([
            'primary_sector_id' => 'required|exists:sectors,id',
            'sector_ids' => 'nullable|array', 
            'sector_order' => 'nullable|string', // Changed to string
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id', // Adjusted validation
            'learning_outcomes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // 1. Create Main Learning Pathway
            $learningPathway = LearningPathway::create([
                'project_id' => $project->id,
                'primary_sector_id' => $request->primary_sector_id,
                'learning_outcomes' => $request->learning_outcomes,
            ]);

            // 2. Attach Sectors (Tab 1)
            if ($request->has('sector_ids')) {
                $sectorsSyncData = [];
                // Use sector_order string (comma separated IDs) to determine order
                $orderedIds = $request->sector_order ? explode(',', $request->sector_order) : $request->sector_ids;
                
                // Filter out any IDs not in the actual selected list (security check)
                $validOrderedIds = array_intersect($orderedIds, $request->sector_ids);
                
                // Add any selected IDs that might be missing from order (edge case) at the end
                $remainingIds = array_diff($request->sector_ids, $validOrderedIds);
                $finalOrder = array_merge($validOrderedIds, $remainingIds);

                foreach ($finalOrder as $index => $sectorId) {
                    $sectorsSyncData[$sectorId] = ['display_order' => $index]; 
                }
                $learningPathway->sectors()->sync($sectorsSyncData);
            }

            // 3. Multidisciplinary Flow (Tab 2)
            if ($request->has('flows')) {
                foreach ($request->flows as $index => $flowData) {
                    if (!empty($flowData['step_title'])) { 
                        LearningPathwayFlow::create([
                            'learning_pathway_id' => $learningPathway->id,
                            'step_no' => $index + 1,
                            'sector_id' => $flowData['sector_id'] ?? null,
                            'step_title' => $flowData['step_title'],
                            'description' => $flowData['description'] ?? null,
                            'skills_text' => $flowData['skills_text'] ?? null,
                        ]);
                    }
                }
            }

            // 4. Training Courses (Tab 3)
            if ($request->has('courses') && is_array($request->courses)) {
                 $coursesSyncData = [];
                 foreach($request->courses as $courseId) {
                     // Check if this course is 'featured'
                     $isFeatured = isset($request->course_featured[$courseId]) ? true : false;
                     // Order
                     $order = isset($request->course_order) ? array_search($courseId, explode(',', $request->course_order)) : 0;
                     
                     $coursesSyncData[$courseId] = [
                         'is_featured' => $isFeatured,
                         'display_order' => $order
                     ];
                 }
                 $learningPathway->courses()->sync($coursesSyncData);
            }

            // 5. Roadmap (Tab 4)
            if ($request->has('roadmaps')) {
                foreach ($request->roadmaps as $index => $roadmapData) {
                    if (!empty($roadmapData['title'])) {
                         LearningPathwayRoadmap::create([
                            'learning_pathway_id' => $learningPathway->id,
                            'step_no' => $index + 1,
                            'title' => $roadmapData['title'],
                            'description' => $roadmapData['description'] ?? null,
                            'badge_text' => $roadmapData['badge_text'] ?? null,
                            'color' => $roadmapData['color'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            notyf()->addSuccess('Learning Pathway created successfully.');
            // Redirect to Edit after creation since it's a singleton
            return redirect()->route('admin.learningpathways.edit', ['project_id' => $project->id, 'id' => $learningPathway->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            notyf()->addError('Error creating Learning Pathway: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($project_id, $id)
    {
        $project = Project::findOrFail($project_id);
        $learningPathway = LearningPathway::with(['sectors', 'flows', 'courses' => function($q) {
            $q->orderBy('learning_pathway_courses.display_order');
        }, 'roadmaps'])->findOrFail($id);
        
        $sectors = Sector::all();
        // Load ALL active courses for the selector, or maybe just load initial set? 
        // For AJAX based UI, we might just need to load the *selected* courses fully, and the rest via AJAX.
        // But keeping it simple for now, load all valid options if list isn't huge. 
        // Or actually, with AJAX approach, we only strictly need the *selected* ones to be pre-filled.
        // The list might be empty initially until sector is selected.
        $courses = Course::where('status', 1)->get();

        return view('admin.learningpathways.edit', compact('project', 'learningPathway', 'sectors', 'courses'));
    }

    public function update(Request $request, $project_id, $id)
    {
        $project = Project::findOrFail($project_id);
        $learningPathway = LearningPathway::findOrFail($id);
        
        // Validation similar to store
         $request->validate([
            'primary_sector_id' => 'required|exists:sectors,id',
            'sector_ids' => 'nullable|array', 
            'sector_order' => 'nullable|string',
            'courses' => 'nullable|array',
            'learning_outcomes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $learningPathway->update([
                'primary_sector_id' => $request->primary_sector_id,
                'learning_outcomes' => $request->learning_outcomes,
            ]);

            // Update Sectors
            if ($request->has('sector_ids')) {
                $sectorsSyncData = [];
                $orderedIds = $request->sector_order ? explode(',', $request->sector_order) : $request->sector_ids;
                $validOrderedIds = array_intersect($orderedIds, $request->sector_ids);
                $remainingIds = array_diff($request->sector_ids, $validOrderedIds);
                $finalOrder = array_merge($validOrderedIds, $remainingIds);

                foreach ($finalOrder as $index => $sectorId) {
                     $sectorsSyncData[$sectorId] = ['display_order' => $index]; 
                }
                $learningPathway->sectors()->sync($sectorsSyncData);
            } else {
                $learningPathway->sectors()->detach();
            }

            // Update Flows
            $learningPathway->flows()->delete();
             if ($request->has('flows')) {
                foreach ($request->flows as $index => $flowData) {
                    if (!empty($flowData['step_title'])) {
                        LearningPathwayFlow::create([
                            'learning_pathway_id' => $learningPathway->id,
                            'step_no' => $index + 1,
                            'sector_id' => $flowData['sector_id'] ?? null,
                            'step_title' => $flowData['step_title'],
                            'description' => $flowData['description'] ?? null,
                            'skills_text' => $flowData['skills_text'] ?? null,
                        ]);
                    }
                }
            }

            // Update Courses
            if ($request->has('courses') && is_array($request->courses)) {
                $coursesSyncData = [];
                foreach($request->courses as $courseId) {
                    $isFeatured = isset($request->course_featured[$courseId]) ? true : false;
                    $order = isset($request->course_order) ? array_search($courseId, explode(',', $request->course_order)) : 0;
                    
                    $coursesSyncData[$courseId] = [
                        'is_featured' => $isFeatured,
                        'display_order' => $order
                    ];
                }
                $learningPathway->courses()->sync($coursesSyncData);
            } else {
                 $learningPathway->courses()->detach();
            }

            // Update Roadmap
            $learningPathway->roadmaps()->delete();
             if ($request->has('roadmaps')) {
                foreach ($request->roadmaps as $index => $roadmapData) {
                    if (!empty($roadmapData['title'])) {
                         LearningPathwayRoadmap::create([
                            'learning_pathway_id' => $learningPathway->id,
                            'step_no' => $index + 1,
                            'title' => $roadmapData['title'],
                            'description' => $roadmapData['description'] ?? null,
                            'badge_text' => $roadmapData['badge_text'] ?? null,
                            'color' => $roadmapData['color'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            notyf()->addSuccess('Learning Pathway updated successfully.');
            return redirect()->route('admin.learningpathways.edit', ['project_id' => $project->id, 'id' => $learningPathway->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            notyf()->addError('Error updating Learning Pathway: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($project_id, $id)
    {
        $project = Project::findOrFail($project_id);
        $learningPathway = LearningPathway::findOrFail($id);
        $learningPathway->delete();
        
        notyf()->addSuccess('Learning Pathway deleted successfully.');
        return redirect()->route('admin.learningpathways.create', $project->id); // Redirect to create since index redirects to edit
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Survey; // Assuming Survey model is in App\Models
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Flasher\Laravel\Facade\Flasher;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For admin to view all surveys
        $surveys = Survey::with('project')->latest()->paginate(20);
        return view('admin.survey.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $projects = Project::select('id', 'title', 'project_code')->get();
        $selectedProjectId = $request->query('project_id');
        
        $existingSurveys = [];
        if ($selectedProjectId) {
            $existingSurveys = Survey::where('project_id', $selectedProjectId)->get();
        }

        return view('admin.survey.create', compact('projects', 'selectedProjectId', 'existingSurveys'));
    }

    /**
     * Store newly created resources in storage (Batch).
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'surveys' => 'required|array',
            'surveys.*.name' => 'required|string|max:255',
            'surveys.*.email' => 'required|email|max:255',
            'surveys.*.role' => 'required|string|max:100',
            'surveys.*.survey_date' => 'required|date',
            'surveys.*.satisfaction' => 'required|string',
            'surveys.*.project_success' => 'required|string',
            'surveys.*.comments' => 'nullable|string',
        ]);

        try {
            \DB::beginTransaction();

            $projectId = $request->project_id;
            $submittedIds = collect($request->surveys)->pluck('id')->filter()->toArray();

            // 1. Delete surveys that were removed in the UI
            Survey::where('project_id', $projectId)
                ->whereNotIn('id', $submittedIds)
                ->delete();

            // 2. Update or Create entries
            foreach ($request->surveys as $surveyData) {
                Survey::updateOrCreate(
                    ['id' => $surveyData['id'] ?? null],
                    array_merge($surveyData, ['project_id' => $projectId])
                );
            }

            \DB::commit();
            Flasher::addSuccess('Surveys updated successfully!');
            return redirect()->route('admin.surveys.index');

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Survey Store Error: ' . $e->getMessage());
            Flasher::addError('An error occurred while saving the surveys.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        return redirect()->route('admin.surveys.create', ['project_id' => $survey->project_id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Survey::destroy($id);
        Flasher::addSuccess('Survey deleted successfully.');
        return redirect()->back();
    }
}

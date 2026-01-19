<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SurveyController extends Controller
{
    public function index($project_id)
    {
        $project = Project::findOrFail($project_id);
        $surveys = Survey::where('project_id', $project_id)->get();
        return view('admin.survey.index', compact('project', 'surveys'));
    }

    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);

        // Define question types for the form
        $questionTypes = [
            'text' => 'Short Text',
            'textarea' => 'Long Text',
            'number' => 'Number',
            'radio' => 'Single Choice (Radio)',
            'checkbox' => 'Multiple Choice (Checkbox)',
            'select' => 'Dropdown',
            'date' => 'Date',
            'file' => 'File Upload',
            'rating' => 'Rating (1-5)',
        ];

        return view('admin.survey.create', compact('project', 'questionTypes'));
    }

    public function store(Request $request, $project_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array',
            'questions.*.text' => 'required|string',
            'questions.*.type' => 'required|string|in:text,textarea,number,radio,checkbox,select,date,file,rating',
            'questions.*.required' => 'nullable|boolean',
            'questions.*.options' => 'nullable|string', // Changed to string as it comes from textarea
        ]);

        $project = Project::findOrFail($project_id);

        // Create the survey
        $survey = Survey::create([
            'project_id' => $project->id,
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'is_active' => true,
        ]);

        // Save questions
        foreach ($request->questions as $questionData) {
            $question = new SurveyQuestion([
                'survey_id' => $survey->id,
                'question_text' => $questionData['text'],
                'type' => $questionData['type'],
                'is_required' => $questionData['required'] ?? false,
                'order' => $questionData['order'] ?? 999,
            ]);

            // Save options for choice-based questions
            if (in_array($questionData['type'], ['radio', 'checkbox', 'select']) && !empty($questionData['options'])) {
                // Split by newline and filter empty lines
                $optionsArray = array_values(array_filter(array_map('trim', explode("\n", $questionData['options']))));
                $question->options = json_encode($optionsArray);
            }

            $question->save();
        }

        notyf()->addSuccess('Survey created successfully.');
        return redirect()->route('admin.survey.index', $project->id);
    }

    public function edit($project_id, $id)
    {
        $project = Project::findOrFail($project_id);
        $survey = Survey::with('questions')->findOrFail($id);
        
        $questionTypes = [
            'text' => 'Short Text',
            'textarea' => 'Long Text',
            'number' => 'Number',
            'radio' => 'Single Choice (Radio)',
            'checkbox' => 'Multiple Choice (Checkbox)',
            'select' => 'Dropdown',
            'date' => 'Date',
            'file' => 'File Upload',
            'rating' => 'Rating (1-5)',
        ];

        return view('admin.survey.edit', compact('project', 'survey', 'questionTypes'));
    }

    public function update(Request $request, $project_id, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array',
            'questions.*.text' => 'required|string',
            'questions.*.type' => 'required|string|in:text,textarea,number,radio,checkbox,select,date,file,rating',
            'questions.*.required' => 'nullable|boolean',
            'questions.*.options' => 'nullable|string',
        ]);

        $project = Project::findOrFail($project_id);
        $survey = Survey::findOrFail($id);

        $survey->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Delete existing questions and re-create (simplest approach for dynamic forms)
        // Or specific logic to update/create/delete
        $survey->questions()->delete();

         // Save questions
         foreach ($request->questions as $questionData) {
            $question = new SurveyQuestion([
                'survey_id' => $survey->id,
                'question_text' => $questionData['text'],
                'type' => $questionData['type'],
                'is_required' => $questionData['required'] ?? false,
                'order' => $questionData['order'] ?? 999,
            ]);

            // Save options for choice-based questions
            if (in_array($questionData['type'], ['radio', 'checkbox', 'select']) && !empty($questionData['options'])) {
                 // Split by newline and filter empty lines
                 $optionsArray = array_values(array_filter(array_map('trim', explode("\n", $questionData['options']))));
                 $question->options = json_encode($optionsArray);
            }

            $question->save();
        }

        notyf()->addSuccess('Survey updated successfully.');
        return redirect()->route('admin.survey.index', $project->id);
    }

    public function destroy($project_id, $id)
    {
        $survey = Survey::findOrFail($id);
        $survey->questions()->delete(); // Ensure questions are deleted
        $survey->delete();

        notyf()->addSuccess('Survey deleted successfully.');
        return redirect()->back();
    }
}

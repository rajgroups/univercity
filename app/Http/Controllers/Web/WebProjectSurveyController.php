<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;

class WebProjectSurveyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'survey_id' => 'required|exists:scrutiny,id',
            'answers' => 'required|array',
        ]);

        try {
            // Check if user has already submitted if you want to limit 1 per user/IP
            // For now, allowing multiple or just logging

            $response = new SurveyResponse();
            $response->survey_id = $request->survey_id;
            $response->user_id = auth()->id() ?? null; // Nullable if guest
            $response->answers = $request->answers;
            $response->ip_address = $request->ip();
            $response->save();

            Flasher::addSuccess('Thank you for your feedback!');
            return redirect()->back();

        } catch (\Exception $e) {
            Flasher::addError('Something went wrong: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}

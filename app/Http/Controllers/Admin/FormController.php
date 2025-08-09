<?php

namespace App\Http\Controllers\Admin; // <-- plural Controllers

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\StudentDetailsMail;
use App\Mail\CooperationDetailsMail;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function sendStudentDetails(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'gender' => 'required|string',
            'dob' => 'nullable|date',
            'mobile' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'state' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'skill_sector' => 'nullable|string|max:255',
            'level' => 'nullable|string',
            'qualification' => 'nullable|string|max:255',
            'status' => 'nullable|string',
            'learning_mode' => 'nullable|string',
            'work_experience' => 'nullable|string',
        ]);

        // Store data in DB (example)
        // Student::create($validated);
        // Mail::to('princesschithra1403@gmail.com')->send(new StudentDetailsMail($validated));
        return back()->with('success', 'Student details submitted successfully!');
    }
}

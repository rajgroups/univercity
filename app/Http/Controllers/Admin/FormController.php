<?php

namespace App\Http\Controllers\Admin; // <-- plural Controllers

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\StudentDetailsMail;
use App\Mail\CooperationDetailsMail;
use App\Mail\OrganizationRegistrationMail;
use App\Models\Organization;
use App\Models\Student;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function sendStudentDetails(Request $request, FlasherInterface $flasher)
    {
        // Custom validation using Validator
        $validator = Validator::make($request->all(), [
            'student_name'    => 'required|string|max:255',
            'father_name'     => 'nullable|string|max:255',
            'mother_name'     => 'nullable|string|max:255',
            'gender'          => 'required|string',
            'dob'             => 'nullable|date',
            'mobile'          => 'nullable|string|max:15',
            'email'           => 'nullable|email',
            'state'           => 'nullable|string|max:255',
            'district'        => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'skill_sector'    => 'nullable|string|max:255',
            'level'           => 'nullable|string',
            'qualification'   => 'nullable|string|max:255',
            'status'          => 'nullable|string',
            'learning_mode'   => 'nullable|string',
            'work_experience' => 'nullable|string',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $flasher->addError($error);
            }
            return redirect()->back()->withInput();
        }

        try {
            $validated = $validator->validated();

            // Save student
            $student = Student::create($validated);

            // Send email
            $adminEmail = env('ADMIN_EMAIL', 'admin@example.com');

            if (!empty($validated['email'])) {
                Mail::to($validated['email'])
                    ->cc($adminEmail)
                    ->send(new StudentDetailsMail($validated));
            } else {
                Mail::to($adminEmail)
                    ->send(new StudentDetailsMail($validated));
            }

            $flasher->addSuccess('Your enquiry has been submitted successfully!');
            return redirect()->back();

        } catch (\Exception $e) {
            $flasher->addError('Failed to submit student details: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function sendOrganizationDetails(Request $request, FlasherInterface $flasher)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            // Organization Details
            'name' => 'required|string|max:255',
            'organization_type' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            
            // Contact Person Details
            'contact_name' => 'required|string|max:255',
            'contact_designation' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'contact_email' => 'required|email|max:255',
            
            // Address Details
            'address' => 'required|string',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city_village' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:10',
            
            // Partnership Interest
            'collaboration' => 'required|string|max:255',
            'beneficiary' => 'required|string|max:255',
        ]);

                // Check for validation errors
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $flasher->addError($error);
            }
            return redirect()->back()->withInput();
        }

        try {
             $validated = $validator->validated();

            // Create organization record
            $organization = Organization::create($validated);

            // Send email notification
            Mail::to($validated['contact_email'])
                ->cc(config('mail.admin_email')) // Add your admin email in config/mail.php
                ->send(new OrganizationRegistrationMail($organization));

            return redirect()->back()
                ->with('success', 'Organization details submitted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error submitting organization details: ' . $e->getMessage())
                ->withInput();
        }
    }
}

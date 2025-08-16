<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Mail\EnquiryNotification;
use App\Mail\EnquiryThankYou;
use App\Models\Enquiry;
use Flasher\Laravel\Facade\Flasher;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|max:255',
            'email'             => 'nullable|email|max:255',
            'mobile'            => 'required|string|max:15|regex:/^[0-9]+$/',
            'type'              => 'required|integer|in:1,2,3,4,5,6,7,8,9', // Only allow 8 or 9 as per your form
            'message'           => 'nullable|string|max:1000',
            'is_philanthropist' => 'nullable|boolean',
            'paid'              => 'nullable|boolean',
            // 'termsCheck'        => 'nullable|accepted'
        ], [
            'name.required' => 'The name field is required.',
            'mobile.required' => 'The mobile number is required.',
            'mobile.regex' => 'Please enter a valid phone number (digits only).',
            'email.email' => 'Please enter a valid email address.',
            'type.in' => 'Invalid enquiry type selected.',
            'termsCheck.accepted' => 'You must accept the terms and conditions.'
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $flasher->addError($error);
            }
            return redirect()->back()->withInput();
        }

        try {
            $enquiry = Enquiry::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'mobile'            => $request->mobile,
                'type'              => $request->type,
                'message'           => $request->message,
                'is_philanthropist' => $request->boolean('is_philanthropist'),
                'paid'              => $request->boolean('paid'),
                'status'            => 1,
            ]);

            // Send emails
            if (!empty($enquiry->email)) {
                Mail::to('admin@example.com')->send(new EnquiryNotification($enquiry));
                Mail::to($enquiry->email)->send(new EnquiryThankYou($enquiry));
            } else {
                Mail::to('admin@example.com')->send(new EnquiryNotification($enquiry));
            }

            $flasher->addSuccess('Your enquiry has been submitted successfully!');
            return redirect()->back();

        } catch (\Exception $e) {
            $flasher->addError('An error occurred while submitting your enquiry. Please try again.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enquiry $enquiry)
    {
        //
    }
}

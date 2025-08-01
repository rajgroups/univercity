<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
public function store(Request $request)
{
    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'mobile' => 'required|string|max:15',
        'is_philanthropist' => 'nullable|boolean',
    ]);

    // Save enquiry to DB
    $enquiry = Enquiry::create([
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'is_philanthropist' => $request->has('is_philanthropist'),
    ]);

    // Send email to admin
    Mail::to('admin@example.com')->send(new \App\Mail\EnquiryNotification($enquiry));

    // Send thank-you mail to user
    Mail::to($enquiry->email)->send(new \App\Mail\EnquiryThankYou($enquiry));

    return redirect()->back()->with('success', 'Your enquiry has been submitted successfully.');
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

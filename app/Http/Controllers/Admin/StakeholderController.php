<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stakeholder;
use Illuminate\Http\Request;

class StakeholderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Stakeholder::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $stakeholders = $query->latest()->paginate(15)->withQueryString();

        return view('admin.stakeholder.list', compact('stakeholders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stakeholder.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:stakeholders,email',
            'phone' => 'nullable|string|max:255',
            'alternate_phone' => 'nullable|string|max:255',
            'type' => 'required|integer',
            'company_name' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'classification' => 'required|integer',
            'status' => 'required|integer',
            'industry' => 'nullable|string|max:255',
            'expertise_area' => 'nullable|string|max:255',
            'preferred_language' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'engagement_level' => 'required|integer|min:1|max:5',
            'influence_level' => 'required|integer|min:1|max:4',
            'interest_level' => 'required|integer|min:1|max:3',
            'last_contacted' => 'nullable|date',
            'next_follow_up' => 'nullable|date',
            'communication_preferences_text' => 'nullable|string',
            'assigned_projects_text' => 'nullable|string',
            'involved_phases_text' => 'nullable|string',
            'metadata_text' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $validated = $this->prepareStakeholderPayload($validated, $request);

        // Generate auto ID if not provided by model observer
        $lastStakeholder = Stakeholder::orderBy('id', 'desc')->first();
        $nextId = $lastStakeholder ? $lastStakeholder->id + 1 : 1;
        $validated['stakeholder_id'] = 'STKH-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        Stakeholder::create($validated);

        return redirect()->route('admin.stakeholder.index')->with('success', 'Stakeholder created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stakeholder $stakeholder)
    {
        return view('admin.stakeholder.show', compact('stakeholder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stakeholder $stakeholder)
    {
        return view('admin.stakeholder.edit', compact('stakeholder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stakeholder $stakeholder)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:stakeholders,email,' . $stakeholder->id,
            'phone' => 'nullable|string|max:255',
            'alternate_phone' => 'nullable|string|max:255',
            'type' => 'required|integer',
            'company_name' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'classification' => 'required|integer',
            'status' => 'required|integer',
            'industry' => 'nullable|string|max:255',
            'expertise_area' => 'nullable|string|max:255',
            'preferred_language' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'engagement_level' => 'required|integer|min:1|max:5',
            'influence_level' => 'required|integer|min:1|max:4',
            'interest_level' => 'required|integer|min:1|max:3',
            'last_contacted' => 'nullable|date',
            'next_follow_up' => 'nullable|date',
            'communication_preferences_text' => 'nullable|string',
            'assigned_projects_text' => 'nullable|string',
            'involved_phases_text' => 'nullable|string',
            'metadata_text' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $validated = $this->prepareStakeholderPayload($validated, $request);

        $stakeholder->update($validated);

        return redirect()->route('admin.stakeholder.index')->with('success', 'Stakeholder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stakeholder $stakeholder)
    {
        $stakeholder->delete();

        return redirect()->route('admin.stakeholder.index')->with('success', 'Stakeholder deleted successfully.');
    }

    private function prepareStakeholderPayload(array $validated, Request $request): array
    {
        $validated['communication_preferences'] = $this->parseLineList($request->input('communication_preferences_text'));
        $validated['assigned_projects'] = $this->parseLineList($request->input('assigned_projects_text'));
        $validated['involved_phases'] = $this->parseLineList($request->input('involved_phases_text'));
        $validated['metadata'] = $this->parseMetadata($request->input('metadata_text'));

        unset(
            $validated['communication_preferences_text'],
            $validated['assigned_projects_text'],
            $validated['involved_phases_text'],
            $validated['metadata_text']
        );

        return $validated;
    }

    private function parseLineList(?string $value): ?array
    {
        if ($value === null) {
            return null;
        }

        $normalized = str_replace(["\r\n", "\r"], "\n", trim($value));

        if ($normalized === '') {
            return null;
        }

        $parts = preg_split('/[\n,]+/', $normalized);
        $parts = array_values(array_filter(array_map('trim', $parts), fn ($item) => $item !== ''));

        return empty($parts) ? null : $parts;
    }

    private function parseMetadata(?string $value): ?array
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim($value);

        if ($trimmed === '') {
            return null;
        }

        $decoded = json_decode($trimmed, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        return ['notes' => $trimmed];
    }
}

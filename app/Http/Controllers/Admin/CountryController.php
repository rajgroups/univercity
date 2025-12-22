<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Region;
use App\Models\Subregion;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List of Country's
        $countries = Country::all();
        return view('admin.country.list',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        $subregions = Subregion::all();

        return view('admin.country.create', compact('regions', 'subregions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'region_id'     => 'required|exists:regions,id',
            'subregion_id'  => 'nullable|exists:subregions,id',
            'code'          => 'required|string|max:2|unique:countries,iso2',
            'status'        => 'required|in:0,1',
            'image'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $country = new Country();
        $country->name = $request->name;
        $country->region_id = $request->region_id;
        $country->subregion_id = $request->subregion_id;
        $country->iso2 = strtoupper($request->code); // save as ISO2
        $country->flag = $request->status;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/countries'), $filename);
            $country->image = $filename; // storing filename in emoji column
        }

        $country->save();
        notyf()->addSuccess('Country created successfully.');
        return redirect()->route('admin.country.index')->with('success', 'Country created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        // Edit Country
        $regions = Region::all();
        $subregions = Subregion::all();
        return view('admin.country.edit',compact('country','regions','subregions'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|string|max:10|unique:countries,iso2,' . $country->id, // iso2 column
            'region_id'   => 'required|exists:regions,id',
            'subregion_id'=> 'nullable|exists:subregions,id',
            'status'      => 'required|in:0,1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Prepare data for update
        $data = [
            'name'        => $validated['name'],
            'iso2'        => $validated['code'], // map "code" input to iso2 column
            'region_id'   => $validated['region_id'],
            'subregion_id'=> $validated['subregion_id'] ?? null,
            'status'      => $validated['status'],
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/countries'), $filename);

            // Delete old image if exists
            if ($country->image && file_exists(public_path('uploads/countries/' . $country->image))) {
                unlink(public_path('uploads/countries/' . $country->image));
            }

            $data['image'] = $filename;
        }

        // Update record
        $country->update($data);
        notyf()->addSuccess('Country updated successfully.');
        return redirect()
            ->route('admin.country.index')
            ->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        try {
            // Delete flag image if exists
            if ($country->image && file_exists(public_path('uploads/countries/' . $country->image))) {
                unlink(public_path('uploads/countries/' . $country->image));
            }

            // Delete the country record
            $country->delete();
            notyf()->addSuccess('Country deleted successfully.');
            return redirect()
                ->route('admin.country.index')
                ->with('success', 'Country deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.country.index')
                ->with('error', 'Failed to delete country. ' . $e->getMessage());
        }
    }

}

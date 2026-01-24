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
            'iso3'          => 'nullable|string|max:3',
            'numeric_code'  => 'nullable|string|max:3',
            'phonecode'     => 'nullable|string|max:255',
            'capital'       => 'nullable|string|max:255',
            'currency'      => 'nullable|string|max:255',
            'currency_name' => 'nullable|string|max:255',
            'currency_symbol'=> 'nullable|string|max:255',
            'tld'           => 'nullable|string|max:255',
            'native'        => 'nullable|string|max:255',
            'nationality'   => 'nullable|string|max:255',
            'latitude'      => 'nullable|numeric',
            'longitude'     => 'nullable|numeric',
            'emoji'         => 'nullable|string|max:191',
            'emojiU'        => 'nullable|string|max:191',
            'wikiDataId'    => 'nullable|string|max:255',
            'status'        => 'required|in:0,1',
            'image'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $country = new Country();
        $country->name = $request->name;
        $country->region_id = $request->region_id;
        $country->subregion_id = $request->subregion_id;
        $country->iso2 = strtoupper($request->code);
        $country->iso3 = $request->iso3 ? strtoupper($request->iso3) : null;
        $country->numeric_code = $request->numeric_code;
        $country->phonecode = $request->phonecode;
        $country->capital = $request->capital;
        $country->currency = $request->currency;
        $country->currency_name = $request->currency_name;
        $country->currency_symbol = $request->currency_symbol;
        $country->tld = $request->tld;
        $country->native = $request->native;
        $country->nationality = $request->nationality;
        $country->latitude = $request->latitude;
        $country->longitude = $request->longitude;
        $country->emoji = $request->emoji;
        $country->emojiU = $request->emojiU;
        $country->wikiDataId = $request->wikiDataId;
        $country->status = $request->status; // Status column
        $country->flag = 1; // Default flag? Or maybe this is active? Migration says tinyInt default 1

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/countries'), $filename);
            $country->image = $filename;
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
            'name'          => 'required|string|max:100',
            'region_id'     => 'required|exists:regions,id',
            'subregion_id'  => 'nullable|exists:subregions,id',
            'code'          => 'required|string|max:2|unique:countries,iso2,' . $country->id,
            'iso3'          => 'nullable|string|max:3',
            'numeric_code'  => 'nullable|string|max:3',
            'phonecode'     => 'nullable|string|max:255',
            'capital'       => 'nullable|string|max:255',
            'currency'      => 'nullable|string|max:255',
            'currency_name' => 'nullable|string|max:255',
            'currency_symbol'=> 'nullable|string|max:255',
            'tld'           => 'nullable|string|max:255',
            'native'        => 'nullable|string|max:255',
            'nationality'   => 'nullable|string|max:255',
            'latitude'      => 'nullable|numeric',
            'longitude'     => 'nullable|numeric',
            'emoji'         => 'nullable|string|max:191',
            'emojiU'        => 'nullable|string|max:191',
            'wikiDataId'    => 'nullable|string|max:255',
            'status'        => 'required|in:0,1',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Prepare data for update
        $data = [
            'name'          => $validated['name'],
            'iso2'          => strtoupper($validated['code']),
            'iso3'          => $validated['iso3'] ? strtoupper($validated['iso3']) : null,
            'numeric_code'  => $validated['numeric_code'],
            'phonecode'     => $validated['phonecode'],
            'capital'       => $validated['capital'],
            'currency'      => $validated['currency'],
            'currency_name' => $validated['currency_name'],
            'currency_symbol'=> $validated['currency_symbol'],
            'tld'           => $validated['tld'],
            'native'        => $validated['native'],
            'nationality'   => $validated['nationality'],
            'latitude'      => $validated['latitude'],
            'longitude'     => $validated['longitude'],
            'emoji'         => $validated['emoji'],
            'emojiU'        => $validated['emojiU'],
            'wikiDataId'    => $validated['wikiDataId'],
            'region_id'     => $validated['region_id'],
            'subregion_id'  => $validated['subregion_id'] ?? null,
            'status'        => $validated['status'],
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use App\Models\Category;
use Flasher\Laravel\Facade\Flasher;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with(['organizer', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.activity.list', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizers = User::all();
        $categories = Category::get();

        return view('admin.activity.create', compact('organizers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'slug'                  => 'required|string|max:255|unique:activities',
            'short_description'     => 'required|string|max:500',
            'description'           => 'required|string',
            'sponsor_name'          => 'nullable|string|max:255',
            'sponsor_details'       => 'nullable|string|max:255',
            'sponsor_logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024', // 1MB max
            'start_date'            => 'required|date',
            'end_date'              => 'required|date|after:start_date',
            'registration_deadline' => 'nullable|date|before:start_date',
            'location'              => 'required|string|max:255',
            'thumbnail_image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image'          => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'images.*'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072', // gallery images
            'type'                  => 'required|in:1,2', // 1=event, 2=competition
            'status'                => 'required|in:0,1,2,3,4', // 0=draft, etc.
            'organizer_id'          => 'nullable|exists:users,id',
            'category_id'           => 'required|exists:category,id',
            'max_participants'      => 'nullable|integer|min:1',
            'entry_fee'             => 'nullable|numeric|min:0',
            'rules'                 => 'nullable|string',
            'highlights'            => 'nullable|array',
            'highlights.*'          => 'string|max:255',
        ]);

        // Handle thumbnail image upload
        if ($request->hasFile('thumbnail_image')) {
            $thumbnail = $request->file('thumbnail_image');
            $thumbnailName = time() . '_thumbnail.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('uploads/activity'), $thumbnailName);
            $validated['thumbnail_image'] = 'uploads/activity/' . $thumbnailName;
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $banner = $request->file('banner_image');
            $bannerName = time() . '_banner.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/activity'), $bannerName);
            $validated['banner_image'] = 'uploads/activity/' . $bannerName;
        }

        // Handle banner sponcer image upload
        if ($request->hasFile('sponsor_logo')) {
            $banner = $request->file('sponsor_logo');
            $bannerName = time() . 'sponsor_logo.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/activity'), $bannerName);
            $validated['sponsor_logo'] = 'uploads/activity/' . $bannerName;
        }

        // Create the activity
        $activity = Activity::create($validated);

        // Handle multiple gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $imageFile) {
                $imageName = time() . '_' . $key . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('uploads/gallery'), $imageName);

                $activity->images()->create([
                    'file_name' => 'uploads/gallery/' . $imageName,
                    'alt_text'  => $activity->title,
                ]);
            }
        }

        // Add a success notification
        notyf()->addSuccess('event or competition created successfully!');
        return redirect()->route('admin.activity.index');
            // ->with('success', 'Activity created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        $activity->load(['organizer', 'category']);
        return view('admin.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $organizers = User::all();
        $categories = Category::get();

        return view('admin.activity.edit', compact('activity', 'organizers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title'                     => 'required|string|max:255',
            'slug'                      => 'required|string|max:255|unique:activities,slug,'.$activity->id,
            'short_description'         => 'required|string|max:500',
            'description'               => 'required|string',
            'sponsor_name'              => 'nullable|string|max:255',
            'sponsor_details'           => 'nullable|string|max:255',
            'sponsor_logo'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'start_date'                => 'required|date',
            'end_date'                  => 'required|date|after:start_date',
            'registration_deadline'     => 'nullable|date|before:start_date',
            'location'                  => 'required|string|max:255',
            'thumbnail_image'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
            'images.*'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
            'type'                      => 'required|in:1,2',
            'status'                    => 'required|in:0,1,2,3,4',
            'organizer_id'              => 'nullable|exists:users,id',
            'category_id'               => 'required|exists:category,id',
            'max_participants'          => 'nullable|integer|min:1',
            'entry_fee'                 => 'nullable|numeric|min:0',
            'rules'                     => 'nullable|string',
            'highlights'                => 'nullable|array',
            'highlights.*'              => 'string|max:255',
        ]);

        // Handle file uploads
        if ($request->hasFile('thumbnail_image')) {
            // Delete old thumbnail if exists
            if ($activity->thumbnail_image && file_exists(public_path($activity->thumbnail_image))) {
                unlink(public_path($activity->thumbnail_image));
            }

            $thumbnailName = time() . '_' . $request->file('thumbnail_image')->getClientOriginalName();
            $request->file('thumbnail_image')->move(public_path('uploads/activity'), $thumbnailName);

            $validated['thumbnail_image'] = 'uploads/activity/' . $thumbnailName;
        }

        if ($request->hasFile('banner_image')) {
            // Delete old banner if exists
            if ($activity->banner_image && file_exists(public_path($activity->banner_image))) {
                unlink(public_path($activity->banner_image));
            }

            $bannerName = time() . '_' . $request->file('banner_image')->getClientOriginalName();
            $request->file('banner_image')->move(public_path('uploads/activity'), $bannerName);

            $validated['banner_image'] = 'uploads/activity/' . $bannerName;
        }

        if ($request->hasFile('sponsor_logo')) {
            // Delete old banner if exists
            if ($activity->banner_image && file_exists(public_path($activity->banner_image))) {
                unlink(public_path($activity->banner_image));
            }

            $bannerName = time() . '_' . $request->file('sponsor_logo')->getClientOriginalName();
            $request->file('sponsor_logo')->move(public_path('uploads/activity'), $bannerName);

            $validated['sponsor_logo'] = 'uploads/activity/' . $bannerName;
        }

        // ✅ Handle gallery images (delete old + upload new)
        if ($request->hasFile('images')) {
            // Delete old images from DB + filesystem
            foreach ($activity->images as $oldImage) {
                if (file_exists(public_path($oldImage->file_name))) {
                    unlink(public_path($oldImage->file_name));
                }
                $oldImage->delete();
            }

            // Save new gallery images
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/gallery'), $imageName);

                $activity->images()->create([
                    'file_name' => 'uploads/gallery/' . $imageName,
                    'is_featured' => false,
                ]);
            }
        }

        $activity->update($validated);
        notyf()->addSuccess('Activity updated successfully!');
        return redirect()->route('admin.activity.index')
            ->with('success', 'Activity updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        // Delete associated files from public folder
        if ($activity->thumbnail_image && file_exists(public_path($activity->thumbnail_image))) {
            unlink(public_path($activity->thumbnail_image));
        }

        if ($activity->banner_image && file_exists(public_path($activity->banner_image))) {
            unlink(public_path($activity->banner_image));
        }

        if ($activity->sponsor_logo && file_exists(public_path($activity->sponsor_logo))) {
            unlink(public_path($activity->sponsor_logo));
        }

        // Delete the activity record
        $activity->delete();
        notyf()->addSuccess(' deleted successfully!');
        return redirect()->route('admin.activity.index')
            ->with('success', 'Activity deleted successfully!');
    }


    /**
     * Generate slug from title (AJAX endpoint)
     */
    public function generateSlug(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        $slug = Str::slug($request->title);

        // Ensure slug is unique
        $count = 1;
        $originalSlug = $slug;
        while (Activity::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return response()->json(['slug' => $slug]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    private function pointRules(): array
    {
        return [
            'points'                => 'nullable|array',
            'points.*.title'        => 'nullable|string|max:255|required_with:points.*.description',
            'points.*.description'  => 'nullable|string|max:500|required_with:points.*.title',
        ];
    }

    private function normalizePoints(?array $points): ?string
    {
        if (empty($points)) {
            return null;
        }

        $normalized = collect($points)
            ->map(function ($point) {
                $title = trim((string) data_get($point, 'title', ''));
                $description = trim((string) data_get($point, 'description', ''));

                if ($title === '' && $description === '') {
                    return null;
                }

                return [
                    'title' => $title,
                    'description' => $description,
                ];
            })
            ->filter()
            ->values()
            ->all();

        return !empty($normalized) ? json_encode($normalized) : null;
    }

    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            // List of Announcement
            $announcements = Announcement::latest()->get(); // You can also paginate: ->paginate(10)
            return view('admin.announcement.list', compact('announcements'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create Announcement
        $categories = Category::where('status', 1)->where('type', 2)->get();
        return view('admin.announcement.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Store Announcement
        $validated = $request->validate([
            'title'             => 'required|string',
            'slug'              => 'required|string|unique:announcement,slug',
            'short_description' => 'required|string',
            'subtitle'          => 'required|string',
            'image'             => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_image'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072', // gallery images
            'type'              => 'required|in:1,2',
            'status'            => 'required|in:0,1',
            'description'       => 'nullable|string',
            'category_id'       => 'nullable|exists:category,id',
            'duration'          => 'nullable|string|max:191',
            'attachments'       => 'nullable|array',
            'attachments.*.name' => 'nullable|string|max:255',
            'attachments.*.file' => 'nullable|file|mimes:pdf|max:10240',
            'source_links'       => 'nullable|array',
            'source_links.*.label' => 'nullable|string|max:255',
            'source_links.*.url'   => 'nullable|url|max:255',
        ] + $this->pointRules());


        // Convert type/status to int
        $validated['type'] = $validated['type'];
        $validated['status'] = $validated['status'];

        $validated['slug'] = Str::slug($validated['slug']);

        // Handle file upload to public folder
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '_img.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/announcements'), $imageName);
            $validated['image'] = 'uploads/announcements/' . $imageName;
        }

        if ($request->hasFile('banner_image')) {
            $banner      = $request->file('banner_image');
            $bannerName  = time() . '_banner.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/announcements'), $bannerName);
            $validated['banner_image'] = 'uploads/announcements/' . $bannerName;
        }

        // Handle PDF Attachments
        $attachmentDetails = [];
        if ($request->has('attachments')) {
            foreach ($request->attachments as $key => $attachment) {
                if ($request->hasFile("attachments.$key.file")) {
                    $file = $request->file("attachments.$key.file");
                    $fileName = time() . "_$key." . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/announcements/attachments'), $fileName);
                    $attachmentDetails[] = [
                        'name' => $attachment['name'] ?? $file->getClientOriginalName(),
                        'file' => 'uploads/announcements/attachments/' . $fileName
                    ];
                }
            }
        }
        $validated['attachment_details'] = !empty($attachmentDetails) ? json_encode($attachmentDetails) : null;

        // Handle Source Links
        $sourceLinks = [];
        if ($request->has('source_links')) {
            foreach ($request->source_links as $link) {
                if (!empty($link['label']) && !empty($link['url'])) {
                    $sourceLinks[] = [
                        'label' => $link['label'],
                        'url'   => $link['url']
                    ];
                }
            }
        }
        $validated['source_links'] = !empty($sourceLinks) ? json_encode($sourceLinks) : null;

        // Save points JSON
        $validated['points'] = $this->normalizePoints($request->input('points'));

        $announcement = Announcement::create($validated);

        // Handle multiple gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $key => $imageFile) {
                $imageName = time() . '_' . $key . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('uploads/gallery'), $imageName);

                $announcement->images()->create([
                    'file_name' => 'uploads/gallery/' . $imageName,
                    'alt_text'  => $announcement->title,
                ]);
            }
        }

        // Add a success notification
        notyf()->addSuccess('Announcement created successfully.');
        return redirect()->route('admin.announcement.index')->with('success', 'Announcement created successfully.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        $categories = Category::where('status', 1)->where('type', 2)->get();

        return view('admin.announcement.edit', compact('announcement', 'categories'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        // Update the Announcement
        $request->validate([
            'title'                 => 'required|string|max:255',
            'subtitle'          => 'required|string',
            'slug'                  => 'required|string|max:255|unique:announcement,slug,' . $announcement->id,
            'type'                  => 'required|in:1,2',
            'status'                => 'required|in:0,1',
            'short_description'     => 'required|string',
            'description'           => 'nullable',
            'gallery.*'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072', // gallery images
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id'       => 'nullable|exists:category,id',
            'duration'          => 'nullable|string|max:191',
            'attachments'       => 'nullable|array',
            'attachments.*.name' => 'nullable|string|max:255',
            'attachments.*.file' => 'nullable|file|mimes:pdf|max:10240',
            'source_links'       => 'nullable|array',
            'source_links.*.label' => 'nullable|string|max:255',
            'source_links.*.url'   => 'nullable|url|max:255',
        ] + $this->pointRules());

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($announcement->image && file_exists(public_path(parse_url($announcement->image, PHP_URL_PATH)))) {
                unlink(public_path(parse_url($announcement->image, PHP_URL_PATH)));
            }

            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('uploads/announcements'), $imageName);
            $announcement->image = asset('uploads/announcements/' . $imageName); // Full path
        }

        if ($request->hasFile('banner_image')) {
            if ($announcement->banner_image && file_exists(public_path(parse_url($announcement->banner_image, PHP_URL_PATH)))) {
                unlink(public_path(parse_url($announcement->banner_image, PHP_URL_PATH)));
            }

            $bannerImageName = time() . '_banner.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('uploads/announcements'), $bannerImageName);
            $announcement->banner_image = asset('uploads/announcements/' . $bannerImageName); // Full path
        }

        // ✅ Handle gallery images (delete old + upload new)
        // ✅ Handle gallery images (delete selected + upload new)
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $imageToDelete = $announcement->images()->find($imageId);
                if ($imageToDelete) {
                    if (file_exists(public_path($imageToDelete->file_name))) {
                        unlink(public_path($imageToDelete->file_name));
                    }
                    $imageToDelete->delete();
                }
            }
        }

        if ($request->hasFile('gallery')) {
            // Append new gallery images
            foreach ($request->file('gallery') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/gallery'), $imageName);

                $announcement->images()->create([
                    'file_name' => 'uploads/gallery/' . $imageName,
                    'is_featured' => false,
                ]);
            }
        }

        // Update fields
        $announcement->title            = $request->title;
        $announcement->slug             = $request->slug;
        $announcement->type             = $request->type;
        $announcement->status           = $request->status;
        $announcement->status           = $request->status;
        $announcement->description      = $request->description;
        $announcement->short_description= $request->short_description;
        $announcement->subtitle         = $request->subtitle;
        $announcement->duration         = $request->duration;
        $announcement->category_id      = $request->category_id;

        // Handle PDF Attachments for Update
        $finalAttachments = [];
        if ($request->has('attachments')) {
            foreach ($request->attachments as $key => $attachment) {
                $item = ['name' => $attachment['name'] ?? null, 'file' => null];
                
                if ($request->hasFile("attachments.$key.file")) {
                    // Upload new file
                    $file = $request->file("attachments.$key.file");
                    $fileName = time() . "_$key." . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/announcements/attachments'), $fileName);
                    $item['file'] = 'uploads/announcements/attachments/' . $fileName;
                    $item['name'] = $item['name'] ?: $file->getClientOriginalName();
                } elseif (!empty($attachment['existing_file'])) {
                    // Keep existing file
                    $item['file'] = $attachment['existing_file'];
                }

                if ($item['file'] && $item['name']) {
                    $finalAttachments[] = $item;
                }
            }
        }
        $announcement->attachment_details = !empty($finalAttachments) ? json_encode($finalAttachments) : null;

        // Handle Source Links for Update
        $sourceLinks = [];
        if ($request->has('source_links')) {
            foreach ($request->source_links as $link) {
                if (!empty($link['label']) && !empty($link['url'])) {
                    $sourceLinks[] = [
                        'label' => $link['label'],
                        'url'   => $link['url']
                    ];
                }
            }
        }
        $announcement->source_links = !empty($sourceLinks) ? json_encode($sourceLinks) : null;

        // Save bullet points as JSON
        $announcement->points = $this->normalizePoints($request->input('points'));

        $announcement->save();
        notyf()->addSuccess('Announcement updated successfully.');
        return redirect()->route('admin.announcement.index')
                        ->with('success', 'Announcement updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        // Delete the Announcement
        try {
            // Delete associated images if stored
            if ($announcement->image && file_exists(public_path($announcement->image))) {
                unlink(public_path($announcement->image));
            }

            if ($announcement->banner_image && file_exists(public_path($announcement->banner_image))) {
                unlink(public_path($announcement->banner_image));
            }

            // Delete record
            $announcement->delete();
            notyf()->addSuccess('Announcement deleted successfully.');
            return redirect()->route('admin.announcement.index')->with('success', 'Announcement deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete announcement.']);
        }
    }

}

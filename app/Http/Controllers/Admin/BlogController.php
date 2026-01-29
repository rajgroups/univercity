<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Course;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Blog News List
        $blogs = Blog::all();
        return view('admin.blog.list',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create Blog
        $categories = Category::where('status', 1)->get();
        return view('admin.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'menu_title'        => 'nullable|string|max:255',
            'category_id'       => 'nullable|exists:category,id',
            'subtitle'          => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'slug'              => 'required|string|max:255|unique:blog,slug',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'banner_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'type'              => 'required|in:1,2,3,4,5,6,7,8,9',
            'description'       => 'required|string',
            'points'            => 'nullable|array',
            'points.*'          => [
                'nullable',
                'string',
                'regex:/^[^-\n\r]+ - [^-]+$/'
            ],
            'status'            => 'nullable|boolean',
        ], [
            'points.*.regex' => 'Each point must contain exactly one " - " with spaces around it.',
        ]);


        try {
            // Filter out empty points and allow only one "-"
            $filteredPoints = null;
            if ($request->points) {
                $filteredPoints = array_filter(array_map(function ($point) {
                    if ($point === null) return null;

                    // Trim spaces
                    $point = trim($point);

                    // Allow only first occurrence of "-"
                    $parts = explode('-', $point, 2);
                    $point = $parts[0];
                    if (isset($parts[1])) {
                        // keep only first "-" + rest (without further "-")
                        $point .= '-' . str_replace(' - ', '', $parts[1]);
                    }

                    return $point !== '' ? $point : null;
                }, $request->points));
            }

            // Handle file uploads - store directly in public folder
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'blog_'.time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/blogs'), $imageName);
            }

            $bannerName = null;
            if ($request->hasFile('banner_image')) {
                $banner = $request->file('banner_image');
                $bannerName = 'banner_'.time().'.'.$banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/blogs'), $bannerName);
            }

            // Create the blog/news
            $blog = Blog::create([
                'title'             => $validated['title'],
                'menu_title'        => $validated['menu_title'],
                'category_id'       => $validated['category_id'],
                'subtitle'          => $validated['subtitle'],
                'short_description' => $validated['short_description'],
                'slug'              => $validated['slug'],
                'image'             => $imageName ? 'uploads/blogs/'.$imageName : null,
                'banner_image'      => $bannerName ? 'uploads/blogs/'.$bannerName : null,
                'type'              => $validated['type'],
                'description'       => $validated['description'],
                'points'            => $filteredPoints ? json_encode($filteredPoints) : null,
                'status'            => $request->has('status') ? 1 : 0,
            ]);

            notyf()->addSuccess('Blog/News created successfully!');
            return redirect()->route('admin.blog.index')
                ->with('success', 'Blog/News created successfully!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error creating blog/news: '.$e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        // $categories = Category::where('status', 1)->get();
        $categories = Category::all(); // Make sure to pass categories if not using a View Composer
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        // Validate the request data
        $validated = $request->validate([
            'title'               => 'required|string|max:255',
            'menu_title'          => 'nullable|string|max:255',
            'category_id'         => 'nullable|exists:category,id',
            'subtitle'            => 'nullable|string|max:255',
            'short_description'   => 'required|string',
            'slug'                => 'required|string|max:255|unique:blog,slug,'.$blog->id,
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'banner_image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'type'                => 'required|in:1,2,3,4,5,6,7,8,9',
            'description'         => 'required|string',
            'points'              => 'nullable|array',
            'points.*'            => [
                'nullable',
                'string',
                'regex:/^[^-\n\r]+ - [^-]+$/'
            ],
            'status'              => 'required|boolean',
            'remove_image'        => 'nullable|boolean',
            'remove_banner_image' => 'nullable|boolean'
        ],
            [
            'points.*.regex' => 'Each point must contain exactly one " - " with spaces around it.',
        ]);

        try {
            // Handle image uploads/removal
            // Handle image uploads/removal
            if ($request->hasFile('image')) {
                // Delete old image
                if ($blog->image && file_exists(public_path($blog->image))) {
                    @unlink(public_path($blog->image));
                } else if ($blog->image && file_exists(public_path('uploads/blogs/'.$blog->image))) {
                     // Fallback check
                    @unlink(public_path('uploads/blogs/'.$blog->image));
                }

                $image = $request->file('image');
                $imageName = 'blog_'.time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/blogs'), $imageName);
                $blog->image = 'uploads/blogs/'.$imageName;
            } elseif ($request->remove_image == 1) {
                 if ($blog->image && file_exists(public_path($blog->image))) {
                    @unlink(public_path($blog->image));
                }
                $blog->image = null;
            }

            if ($request->hasFile('banner_image')) {
                 // Delete old banner
                if ($blog->banner_image && file_exists(public_path($blog->banner_image))) {
                    @unlink(public_path($blog->banner_image));
                }

                $banner = $request->file('banner_image');
                $bannerName = 'banner_'.time().'.'.$banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/blogs'), $bannerName);
                $blog->banner_image = 'uploads/blogs/'.$bannerName;
            } elseif ($request->remove_banner_image == 1) {
                 if ($blog->banner_image && file_exists(public_path($blog->banner_image))) {
                    @unlink(public_path($blog->banner_image));
                }
                $blog->banner_image = null;
            }

            // Filter out empty points and allow only one "-"
            $filteredPoints = null;
            if ($request->points) {
                $filteredPoints = array_filter(array_map(function ($point) {
                    if ($point === null) return null;

                    $point = trim($point);

                    // Allow only first occurrence of "-"
                    $parts = explode('-', $point, 2);
                    $point = $parts[0];
                    if (isset($parts[1])) {
                        $point .= '-' . str_replace(' - ', '', $parts[1]);
                    }

                    return $point !== '' ? $point : null;
                }, $request->points));
            }

            // Update the blog
            $blog->update([
                'title'             => $validated['title'],
                'menu_title'        => $validated['menu_title'],
                'category_id'       => $validated['category_id'],
                'subtitle'          => $validated['subtitle'],
                'short_description' => $validated['short_description'],
                'slug'              => $validated['slug'],
                // Images are handled above by modifying the model instance directly
                // 'image'             => $imagePath,
                // 'banner_image'      => $bannerPath,
                'type'              => $validated['type'],
                'description'       => $validated['description'],
                'points'            => $filteredPoints ? json_encode($filteredPoints) : null,
                'status'            => $validated['status'],
            ]);

            $blog->save(); // Save the model with potential image changes

            notyf()->addSuccess('Blog/News updated successfully!');
            return redirect()->route('admin.blog.index')
                ->with('success', 'Blog/News updated successfully!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error updating blog/news: '.$e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        try {
            // Delete associated images if they exist
            if ($blog->image && file_exists(public_path('uploads/blogs/'.$blog->image))) {
                unlink(public_path('uploads/blogs/'.$blog->image));
            }

            if ($blog->banner_image && file_exists(public_path('uploads/blogs/'.$blog->banner_image))) {
                unlink(public_path('uploads/blogs/'.$blog->banner_image));
            }

            // Delete the blog record
            $blog->delete();
            notyf()->addSuccess('Blog/News deleted successfully!');
            return redirect()->route('admin.blog.index')
                ->with('success', 'Blog/News deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('admin.blog.index')
                ->with('error', 'Error deleting blog/news: '.$e->getMessage());
        }
    }
}

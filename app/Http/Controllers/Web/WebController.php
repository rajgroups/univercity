<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Course;
use App\Models\Project;
use App\Models\Sector;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function home(){


        /**
         * Company Projects
         * upcoming
         * ongoing
         */
        // 1=>ongoing,2=>upcoming
        $ongoingProjects = Project::where('status',1)->where('type',1)->latest()->limit(10)->get();
        $upcomingProjects = Project::where('status',1)->where('type',2)->latest()->limit(10)->get();

        // 1=>program,2=>Scheme
        $programes = Announcement::where('status',1)->where('type',1)->latest()->limit(10)->get();
        $schemes = Announcement::where('status',1)->where('type',2)->latest()->limit(10)->get();

        // Fetch only active banners with image field
        $banners = Banner::where('status', 1)->select('image')->get();

        return view('web.index',compact(
            'ongoingProjects',
            'upcomingProjects',
            'programes',
            'schemes',
            'banners'
        ));
    }

    public function program($category, $slug){
        // Get the category by slug
        $category = Category::where('slug', $category)->firstOrFail();

        // Get the announcement by category ID and slug
        $program = Announcement::where('slug', $slug)
                    ->where('type',1)
                    ->where('category_id', $category->id)
                    ->firstOrFail();
        $similars = Announcement::where('type', 1)
            ->where('id', '!=', $program->id)
            ->where('category_id', $category->id)
            ->latest()
            ->limit(5)
            ->get();
        // Return view with data
        return view('web.programe', compact('program','similars'));
    }

    public function scheme($category, $slug){
        // Get the category by slug
        $category = Category::where('slug', $category)->firstOrFail();

        // Get the announcement by category ID and slug
        $announcement = Announcement::where('slug', $slug)
                    ->where('type',2)
                    ->where('category_id', $category->id)
                    ->firstOrFail();
        $similars = Announcement::where('type', 2)
            ->where('id', '!=', $announcement->id)
            ->where('category_id', $category->id)
            ->latest()
            ->limit(5)
            ->get();
        // Return view with data
        return view('web.scheme', compact('announcement','similars'));
    }

    public function upcoming($category, $slug){
        // Get the category by slug
        $category = Category::where('slug', $category)->firstOrFail();

        // Get the announcement by category ID and slug
        $program = Project::where('slug', $slug)
                    ->where('type',2)
                    ->where('category_id', $category->id)
                    ->firstOrFail();
        $similars = Project::where('type', 2)
            ->where('id', '!=', $program->id)
            ->where('category_id', $category->id)
            ->latest()
            ->limit(5)
            ->get();
        // Return view with data
        return view('web.projectupcoming', compact('program','similars'));
    }

    public function ongoing($category, $slug){
        // Get the category by slug
        $category = Category::where('slug', $category)->firstOrFail();

        // Get the announcement by category ID and slug
        $announcement = Project::where('slug', $slug)
                    ->where('type',1)
                    ->where('category_id', $category->id)
                    ->firstOrFail();
        $similars = Project::where('type', 1)
            ->where('id', '!=', $announcement->id)
            ->where('category_id', $category->id)
            ->latest()
            ->limit(5)
            ->get();
        // Return view with data
        return view('web.projectongoing', compact('announcement','similars'));
    }
    
    public function sectors(Request $request)
    {
        $query = Sector::where('status', 1);

        if ($request->has('searchQueryInput') && !empty($request->searchQueryInput)) {
            $search = $request->searchQueryInput;
            $query->where('name', 'like', "%{$search}%");
        }

        $sectors = $query->paginate(8)->appends($request->all()); // Preserve search on pagination

        return view('web.sector', compact('sectors'));
    }

    public function course(Request $request)
    {
        $query = Course::query();
        
        // 🔍 Search filter (by title or description)
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                ->orWhere('short_description', 'like', "%$search%");
            });
        }
        
        // Language filter
        if ($request->has('languages')) {
            $query->whereIn('language', $request->input('languages'));
        }
        
        // Duration filter
        if ($request->has('durations')) {
            $durationConditions = [];
            foreach ($request->input('durations') as $duration) {
                if ($duration === '1-2 Hours') {
                    $durationConditions[] = ['duration', 'like', '%1-2%'];
                } elseif ($duration === '3+ Hours') {
                    $durationConditions[] = ['duration', 'like', '%3+%'];
                }
            }
            $query->where(function($q) use ($durationConditions) {
                foreach ($durationConditions as $condition) {
                    $q->orWhere([$condition]);
                }
            });
        }
        
        // Learning Product Type filter
        if ($request->has('product_types')) {
            $query->whereIn('learning_product_type', $request->input('product_types'));
        }
        
        // Price filter
        if ($request->has('prices')) {
            if (in_array('Free', $request->input('prices'))) {
                $query->where('paid_type', 'Free');
            }
            if (in_array('Paid', $request->input('prices'))) {
                $query->orWhere('paid_type', 'Paid');
            }
        }
        
        // Sector filter
        if ($request->has('sectors')) {
            $query->whereIn('sector_id', $request->input('sectors'));
        }
        
        $courses = $query->paginate(10);
        $sectors = Sector::all(); // For sector filter options
        
        return view('web.course', compact('courses', 'sectors'));
    }
}

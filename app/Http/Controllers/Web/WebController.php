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
                $q->where('name', 'like', "%$search%")
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

    public function courseDetails(Request $request,$slug){
        // Find Course Record From Course table
        $course = Course::where('slug',$slug)->first();

        // get All Sectors
        $sectors = Sector::where('status',1)->get();


        // Get other courses except current one
        $otherCourses = Course::where('slug', '!=', $slug)->latest()->limit(6)->get();

        // ✅ Fetch latest 2-3 blogs
        // $blogs = Blog::where('status', 1)->latest()->limit(3)->get();

        // 1=>ongoing,2=>upcoming
        $ongoingProjects = Project::where('status',1)->where('type',1)->latest()->limit(10)->get();
        $upcomingProjects = Project::where('status',1)->where('type',2)->latest()->limit(10)->get();

        // 1=>program,2=>Scheme
        $programes = Announcement::where('status',1)->where('type',1)->latest()->limit(10)->get();
        $schemes = Announcement::where('status',1)->where('type',2)->latest()->limit(10)->get();

        // Fetch only active banners with image field
        $banners = Banner::where('status', 1)->select('image')->get();

        return view('web.coursedetail',compact(
            'ongoingProjects',
            'upcomingProjects',
            'programes',
            'schemes',
            'banners',
            'course',
            'sectors',
            'otherCourses',
            // 'blogs',
        ));
    }

    public function catalog(Request $request)
    {
        $projects = Project::query();
        $announcements = Announcement::query();

        // Filter: Category
        if ($request->filled('category_id')) {
            $projects->where('category_id', $request->category_id);
            $announcements->where('category_id', $request->category_id);
        }

        // Filter: Type
        if ($request->type === 'project_1') {
            $projects->where('type', 1);
            $announcements->whereRaw('1=0'); // skip
        } elseif ($request->type === 'project_2') {
            $projects->where('type', 2);
            $announcements->whereRaw('1=0');
        } elseif ($request->type === 'announcement_1') {
            $announcements->where('type', 1);
            $projects->whereRaw('1=0');
        } elseif ($request->type === 'announcement_2') {
            $announcements->where('type', 2);
            $projects->whereRaw('1=0');
        }

        // Filter: Search
        if ($request->filled('search')) {
            $projects->where('title', 'like', '%' . $request->search . '%');
            $announcements->where('title', 'like', '%' . $request->search . '%');
        }

        // Fetch and tag type for frontend
        $projectResults = $projects->get()->map(function ($item) {
            $item->type_label = $item->type == 1 ? 'Ongoing' : 'Upcoming';
            $item->item_type = 'project';
            return $item;
        });

        $announcementResults = $announcements->get()->map(function ($item) {
            $item->type_label = $item->type == 1 ? 'Program' : 'Scheme';
            $item->item_type = 'announcement';
            return $item;
        });

        // Merge, sort and paginate
        $merged = $projectResults->merge($announcementResults)->sortByDesc('created_at');

        $perPage = 9;
        $currentPage = $request->get('page', 1);
        $results = new \Illuminate\Pagination\LengthAwarePaginator(
            $merged->forPage($currentPage, $perPage),
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('web.catalog', [
            'results' => $results,
            'categories' => Category::all()
        ]);
    }

    public function blog(Request $request)
    {
        $query = Blog::query()->with('category');

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $blogs = $query->latest()->paginate(12);
        $categories = Category::whereHas('blogs')->get();

        return view('web.blog.filter', compact('blogs', 'categories'));
    }

    public function blogShow($categorySlug, $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        return view('web.blog.show', compact('blog'));
    }

}

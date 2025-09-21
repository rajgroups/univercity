<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Course;
use App\Models\IntlCourse;
use App\Models\Project;
use App\Models\Sector;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        // User Testimonial
        $testimonials = Testimonial::where('status',1)->latest()->limit(10)->get();

        // Brands
        $brands = Brand::where('status',1)->latest()->limit(10)->get();
        // blog
        $blogs = Blog::with(['category'])->where('status', 1)
            ->where('type', 2)
            ->latest()
            ->get();

        return view('web.index',compact(
            'ongoingProjects',
            'upcomingProjects',
            'programes',
            'schemes',
            'banners',
            'testimonials',
            'brands',
            'blogs'
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
        // dd('hi');
        $query = Sector::where('status', 1)
            ->where('type', 1);

        if ($request->filled('searchQueryInput')) {
            $search = $request->searchQueryInput;
            $query->where('name', 'like', "%{$search}%");
        }

        // 🔽 Order sectors by position first, then by name (or created_at as fallback)
        $sectors = $query->orderBy('position', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(8)
            ->appends($request->all()); // Preserve search on pagination

        return view('web.sector', compact('sectors'));
    }

    public function courseCountry(Request $request)
    {
        // dd('hi');
        $query = Country::where('status', 1);

        if ($request->has('searchQueryInput') && !empty($request->searchQueryInput)) {
            $search = $request->searchQueryInput;
            $query->where('name', 'like', "%{$search}%");
        }

        $country = $query->paginate(8)->appends($request->all()); // Preserve search on pagination

        return view('web.globalpathwaycountry', compact('country'));
    }

    public function globalcourse(Request $request)
    {

        $query = IntlCourse::query();

        // ✅ Must Active Course Only
        $query->where('status', 1);

        // 🔍 Search filter (by title or description)
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('short_description', 'like', "%$search%");
            });
        }

        // 🌐 Language filter
        if ($request->has('languages')) {
            $query->whereIn('language', $request->input('languages'));
        }

        // ⏱️ Duration filter
        if ($request->has('durations')) {
            $durationConditions = [];
            foreach ($request->input('durations') as $duration) {
                if ($duration === '1-2 Hours') {
                    $durationConditions[] = ['duration', 'like', '%1-2%'];
                } elseif ($duration === '3+ Hours') {
                    $durationConditions[] = ['duration', 'like', '%3+%'];
                }
            }
            $query->where(function ($q) use ($durationConditions) {
                foreach ($durationConditions as $condition) {
                    $q->orWhere([$condition]);
                }
            });
        }

        // 🎓 Learning Product Type filter
        if ($request->has('product_types')) {
            $query->whereIn('learning_product_type', $request->input('product_types'));
        }

        // 💰 Price filter
        if ($request->has('prices')) {
            $query->where(function ($q) use ($request) {
                if (in_array('Free', $request->input('prices'))) {
                    $q->orWhere('paid_type', 'Free');
                }
                if (in_array('Paid', $request->input('prices'))) {
                    $q->orWhere('paid_type', 'Paid');
                }
            });
        }

        // 🏭 Sector filter
        if ($request->has('sectors')) {
            $query->whereIn('sector_id', $request->input('sectors'));
        }

        // 🌍 Country filter
        if ($request->has('country')) {
            $query->whereIn('country_id', $request->input('country'));
        }

        // 📂 Category filter
        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->input('categories'));
        }

        // 📊 Get results with pagination
        $courses = $query->paginate(10);

        // Dropdown filter options
        $sectors = Sector::where('type',2)->get();
        $countries = Country::where('status', 1)->get();
        $categories = Category::where('type', 6)->get();

        return view('web.globalcourse', compact('courses', 'sectors', 'countries', 'categories'));
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
        $sectors = Sector::where('type',1)->get(); // For sector filter options

        return view('web.course', compact('courses', 'sectors'));
    }

    public function globalcourseDetails(Request $request,$slug){
        // Find Course Record From Course table
        $course = IntlCourse::with([
                'country' => function ($q) {
                    $q->select('id', 'name'); // ✅ load only id + name
                },
                'category' => function ($q) {
                    $q->select('id', 'name'); // ✅ load only id + name
                }
            ])->where('slug',$slug)->first();

        // get All Sectors
        $sectors = Sector::where('status',1)->get();


        // Get other courses except current one
        $otherCourses = IntlCourse::where('slug', '!=', $slug)->latest()->limit(6)->get();

        // ✅ Fetch latest 2-3 blogss
        // $blogs = Blog::where('status', 1)->latest()->limit(3)->get();

        // 1=>ongoing,2=>upcoming
        $ongoingProjects = Project::where('status',1)->where('type',1)->latest()->limit(10)->get();
        $upcomingProjects = Project::where('status',1)->where('type',2)->latest()->limit(10)->get();

        // 1=>program,2=>Scheme
        $programes = Announcement::where('status',1)->where('type',1)->latest()->limit(10)->get();
        $schemes = Announcement::where('status',1)->where('type',2)->latest()->limit(10)->get();

        // Fetch only active banners with image field
        $banners = Banner::where('status', 1)->select('image')->get();
                // dd($course);
        return view('web.globalcoursedetails',compact(
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
        if (in_array($request->type, ['project_1', 'project_2', 'announcement_1', 'announcement_2'])) {
            if ($request->type === 'project_1') {
                $projects->where('type', 1);
                $announcements->whereRaw('1=0');
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

        return view('web.blog', compact('blogs', 'categories'));
    }

    public function blogShow($categorySlug, $slug)
    {
        // Get the category by slug
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Get the blog by category ID and slug
        $blog = Blog::where('slug', $slug)
            ->where('category_id', $category->id)
            ->with('category')
            ->firstOrFail();

        // Get similar blogs from the same category
        $similars = Blog::where('id', '!=', $blog->id)
            ->where('category_id', $category->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('web.blogview', compact('blog', 'similars'));
    }


    public function activityFilter(Request $request)
    {
        // Get all filter parameters from the request
        $search = $request->input('search');
        $types = $request->input('types', []);
        $locations = $request->input('locations', []);
        $categories = $request->input('categories', []);
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $sort = $request->input('sort', 'newest_first');

        // Base query for upcoming events
        $events = Activity::query()
            ->where('start_date', '>=', now())
            ->with('category');

        // Apply search filter
        if ($search) {
            $events->where(function($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%')
                      ->orWhere('description', 'like', '%'.$search.'%')
                      ->orWhere('organizer_id', 'like', '%'.$search.'%');
            });
        }

        // Apply type filter
        if (!empty($types)) {
            $events->whereIn('type', $types);
        }

        // Apply location filter
        if (!empty($locations)) {
            $events->whereIn('location_type', $locations);
        }

        // Apply category filter
        if (!empty($categories)) {
            $events->whereIn('category_id', $categories);
        }

        // Apply date range filter
        if ($start_date) {
            $events->where('start_date', '>=', $start_date);
        }
        if ($end_date) {
            $events->where('start_date', '<=', $end_date);
        }

        // Apply sorting
        switch ($sort) {
            case 'date_soonest':
                $events->orderBy('start_date')->orderBy('start_time');
                break;
            case 'popular':
                // Assuming you have a 'views' or 'registrations_count' column
                $events->orderBy('registrations_count', 'desc');
                break;
            case 'newest_first':
            default:
                $events->orderBy('created_at', 'desc');
                break;
        }

        // Get all categories for filter sidebar
        $categories = Category::get();

        // Paginate results (15 items per page)
        $events = $events->paginate(15);

        return view('web.activity', [
            'events' => $events,
            'categories' => $categories,
            'filters' => [
                'search' => $search,
                'types' => $types,
                'locations' => $locations,
                'categories' => $categories,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'sort' => $sort
            ]
        ]);
    }

        // Show single event/competition
    public function activityShow($slug)
    {
        // Get the event with related data
        $event = Activity::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        // Check if registration deadline has passed
        $registrationClosed = Carbon::now()->gt($event->registration_deadline);

        // Get similar events (same category, excluding current event)
        $similarEvents = Activity::where('category_id', $event->category_id)
            ->where('id', '!=', $event->id)
            ->where('status', 'published')
            ->orderBy('start_date', 'asc')
            ->limit(3)
            ->get();

        // Prepare agenda if exists
        $agenda = null;
        if ($event->agenda) {
            $agenda = json_decode($event->agenda, true);
        }

        // Prepare rules if competition
        $rules = null;
        if ($event->is_competition && $event->rules) {
            $rules = json_decode($event->rules, true);
        }

        // Prepare meta data
        $metaTitle = $event->meta_title ?? $event->title;
        $metaDescription = $event->meta_description ?? Str::limit(strip_tags($event->description), 150);
        $metaImage = $event->image ? asset($event->image) : asset('images/default-event.jpg');

        return view('web.activityshow', compact(
            'event',
            'registrationClosed',
            'similarEvents',
            'agenda',
            'rules',
            'metaTitle',
            'metaDescription',
            'metaImage'
        ));
    }

}

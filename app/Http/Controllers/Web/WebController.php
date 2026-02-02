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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WebController extends Controller
{
    //
    public function home()
    {
        /**
         * Company Projects - Three Stages
         * upcoming, ongoing, completed
         */
        $upcomingProjects = Project::where('status', 1)
            ->where('stage', 'upcoming')
            ->latest()
            ->limit(10)
            ->get();

        $ongoingProjects = Project::where('status', 1)
            ->where('stage', 'ongoing')
            ->latest()
            ->limit(10)
            ->get();

        $completedProjects = Project::where('status', 1)
            ->where('stage', 'completed')
            ->latest()
            ->limit(10)
            ->get();

        // 1=>program,2=>Scheme
        $programes = Announcement::where('status', 1)
            ->where('type', 1)
            ->latest()
            ->limit(10)
            ->get();

        $schemes = Announcement::where('status', 1)
            ->where('type', 2)
            ->latest()
            ->limit(10)
            ->get();

        // Fetch only active banners with image field
        $banners = Banner::where('status', 1)->select('image')->get();

        // User Testimonial
        $testimonials = Testimonial::where('status', 1)
            ->latest()
            ->limit(10)
            ->get();

        // Brands
        $brands = Brand::where('status', 1)
            ->latest()
            ->limit(10)
            ->get();

        // blog
        $blogs = Blog::with(['category'])
            ->where('status', 1)
            ->where('type', 2)
            ->latest()
            ->get();

        return view('web.index', compact(
            'upcomingProjects',
            'ongoingProjects',
            'completedProjects',
            'programes',
            'schemes',
            'banners',
            'testimonials',
            'brands',
            'blogs'
        ));
    }
    public function program($category, $slug){
        // Find the program by slug and type (1)
        $program = Announcement::where('slug', $slug)
                    ->where('type', 1)
                    ->where('status', 1)
                    ->with('category')
                    ->firstOrFail();

        // Get similar programs from the same category
        $similars = Announcement::where('type', 1)
            ->where('id', '!=', $program->id)
            ->where('category_id', $program->category_id)
            ->latest()
            ->limit(5)
            ->get();

        // Return view with data
        return view('web.programe', compact('program','similars'));
    }

    public function scheme($category, $slug){
        // Find the scheme by slug and type (2)
        // Find the scheme by slug and type (2)
        $announcement = Announcement::where('slug', $slug)
                    ->where('type', 2)
                    ->where('status', 1)
                    ->with('category')
                    ->firstOrFail();

        // Get similar schemes from the same category
        $similars = Announcement::where('type', 2)
            ->where('id', '!=', $announcement->id)
            ->where('category_id', $announcement->category_id)
            ->latest()
            ->limit(5)
            ->get();

        // Return view with data
        return view('web.scheme', compact('announcement','similars'));
    }

    public function showProject($categorySlug, $slug)
    {
        // 1️⃣ Find category
        $category = Category::where('slug', $categorySlug)
            // ->where('status', 1) // Optional: enforce active category
            ->firstOrFail();

        // 2️⃣ Find the project with relationships
        $project = Project::where('slug', $slug)
            ->where('category_id', $category->id)
            ->where('status', 1)
            ->with([
                'category',
                'milestones',
                'estimation.items',
                'donors',
                'fundings',
                'utilizations',
                'feedbacks',
                'surveys' => function($query) {
                    $query->with(['responses' => function($q) {
                        if (auth()->check()) {
                            $q->where('user_id', auth()->id());
                        } else {
                            $q->whereNull('id'); // No responses for guests
                        }
                    }, 'questions']);
                },
                'learningPathway.sectors',
                'learningPathway.flows.sector',
                'learningPathway.courses.sector',
                'learningPathway.roadmaps',
                'beneficiaries.updates', // Eager load beneficiaries and updates
            ])
            ->firstOrFail();

        // 3️⃣ Extract data for view
        $milestones = $project->milestones;
        $estimation = $project->estimation;
        $donors = $project->donors;
        $fundings = $project->fundings;
        $utilizations = $project->utilizations;
        $feedbacks = $project->feedbacks;
        $surveys = $project->surveys; // Dynamic surveys

        // 4️⃣ Calculate survey statistics
        $surveyStats = [
            'total' => $feedbacks->count(),
            'satisfaction' => [
                'Very Satisfied' => $feedbacks->where('satisfaction', 'Very Satisfied')->count(),
                'Satisfied' => $feedbacks->where('satisfaction', 'Satisfied')->count(),
                'Neutral' => $feedbacks->where('satisfaction', 'Neutral')->count(),
                'Dissatisfied' => $feedbacks->where('satisfaction', 'Dissatisfied')->count(),
            ],
            'success' => [
                'Yes' => $feedbacks->where('project_success', 'Yes')->count(),
                'No' => $feedbacks->where('project_success', 'No')->count(),
                'Not Sure' => $feedbacks->where('project_success', 'Not Sure')->count(),
            ],
            'roles' => $feedbacks->groupBy('role')->map->count(),
        ];

        // 5️⃣ Resolve stakeholders from milestones
        // Note: We need to import Stakeholder m    odel or use full path
        $stakeholderIds = $milestones->pluck('stakeholder_id')->filter()->unique();
        $stakeholders = \App\Models\Stakeholder::whereIn('id', $stakeholderIds)->get()->keyBy('id');

        // 5.1️⃣ Calculate budget totals
        $totalRaised = $donors->sum('amount');
        $totalReceived = $fundings->sum('amount');

        // 5.2️⃣ Resolve Government Schemes titles
        $govtSchemeSlugs = $project->govt_schemes;
        if (is_string($govtSchemeSlugs)) {
            $govtSchemeSlugs = json_decode($govtSchemeSlugs, true) ?: [];
        }
        $govtSchemeTitles = \App\Models\Announcement::where('type', 2)
            ->whereIn('slug', (array)$govtSchemeSlugs)
            ->pluck('title', 'slug');

        // 5.3 Benefit Chart Data
        $beneficiaryChartData = $this->getBeneficiaryChartData($project);
        Log::info($beneficiaryChartData);
        // 5.4 Beneficiary Breakdown Data
        $beneficiaryGroups = $project->beneficiaries->filter(function ($value) {
            return strtolower($value->type) === 'group';
        })->values();

        $beneficiaryIndividuals = $project->beneficiaries->filter(function ($value) {
            return strtolower($value->type) === 'individual';
        })->values();

        $beneficiaryGroupsData = [
            'labels' => $beneficiaryGroups->pluck('category'),
            'targets' => $beneficiaryGroups->pluck('target_number'),
            'reached' => $beneficiaryGroups->pluck('reached_number'),
        ];

        $beneficiaryIndividualsData = [
            'labels' => $beneficiaryIndividuals->pluck('category'),
            'targets' => $beneficiaryIndividuals->pluck('target_number'),
            'reached' => $beneficiaryIndividuals->pluck('reached_number'),
        ];

        // 6️⃣ Return view
        return view('web.project', compact(
            'project',
            'category',
            'milestones',
            'estimation',
            'donors',
            'fundings',
            'utilizations',
            'stakeholders',
            'stakeholders',
            'surveys',
            'feedbacks',
            'surveyStats',
            'totalRaised',
            'totalReceived',
            'govtSchemeTitles',
            'beneficiaryChartData',
            'beneficiaryGroupsData',
            'beneficiaryIndividualsData'
        ));
    }

    private function getBeneficiaryChartData($project)
    {
        $allUpdates = collect();

        // Collect all updates with their dates
        foreach ($project->beneficiaries as $ben) {
            foreach ($ben->updates as $update) {
                $allUpdates->push([
                    'beneficiary_id' => $ben->id,
                    'date' => $update->date,
                    'reached' => (int) $update->reached_number,
                    'created_at' => $update->created_at
                ]);
            }
        }

        if ($allUpdates->isEmpty()) {
            return ['labels' => [], 'values' => []];
        }

        // Sort all updates by date
        $sortedUpdates = $allUpdates->sortBy('date');

        // Group updates by date and calculate daily totals
        $dailyData = $sortedUpdates->groupBy('date')->map(function ($updates) {
            return $updates->sum('reached');
        });

        // Convert to arrays
        $dates = $dailyData->keys()->sort()->values();
        $dailyValues = $dailyData->values();

        // Calculate cumulative values
        $cumulativeValues = [];
        $runningTotal = 0;

        foreach ($dailyValues as $value) {
            $runningTotal += $value;
            $cumulativeValues[] = $runningTotal;
        }

        // Format labels
        $labels = $dates->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('d M Y');
        })->toArray();

        return [
            'labels' => $labels,
            'values' => $cumulativeValues
        ];
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

    // ✅ Must Active Course Only (using publish_status instead of status)
    $query->where('publish_status', 1);

    // 🔍 Search filter (by course_title or short_description)
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('course_title', 'like', "%$search%")
              ->orWhere('short_description', 'like', "%$search%");
        });
    }

    // 🌐 Language filter (using JSON field)
    if ($request->has('languages') && !empty($request->languages)) {
        $query->where(function ($q) use ($request) {
            foreach ($request->languages as $language) {
                $q->orWhereJsonContains('language_of_instruction', $language);
            }
        });
    }

    // ⏱️ Duration filter (using course_duration_overseas)
    if ($request->has('durations') && !empty($request->durations)) {
        $query->where(function ($q) use ($request) {
            foreach ($request->durations as $duration) {
                $q->orWhere('course_duration_overseas', 'like', "%$duration%");
            }
        });
    }

    // 💰 Price filter (using paid_type)
    if ($request->has('prices') && !empty($request->prices)) {
        $query->whereIn('paid_type', $request->prices);
    }

    // 🏭 Sector filter
    if ($request->has('sectors') && !empty($request->sectors)) {
        $query->whereIn('sector_id', $request->sectors);
    }

    // 🌍 Country filter
    if ($request->has('countries') && !empty($request->countries)) {
        $countries = $request->countries;

        // Normalize to array if string (e.g. ?countries=IND or ?countries=IND,USA)
        if (is_string($countries)) {
            $countries = explode(',', $countries);
        }

        // Resolve ISO3 codes to IDs
        $countryIds = Country::whereIn('iso3', $countries)->pluck('id');

        if ($countryIds->isNotEmpty()) {
            $query->whereIn('country_id', $countryIds);
        } else {
             // Fallback: search by ID if ISO3 fails
             $query->whereIn('country_id', (array) $request->countries);
        }
    }

    // 📂 Category filter
    if ($request->has('categories') && !empty($request->categories)) {
        $query->whereIn('category_id', $request->categories);
    }

    // 🎓 Pathway Type filter
    if ($request->has('pathways') && !empty($request->pathways)) {
        $query->whereIn('pathway_type', $request->pathways);
    }

    // 📊 Get results with pagination and relationships
    $sort = $request->input('sort', 'newest');
    switch ($sort) {
        case 'oldest':
            $query->orderBy('created_at', 'asc');
            break;
        case 'name_asc':
            $query->orderBy('course_title', 'asc');
            break;
        case 'name_desc':
            $query->orderBy('course_title', 'desc');
            break;
        case 'newest':
        default:
            $query->orderBy('display_order', 'asc')
                  ->orderBy('created_at', 'desc');
            break;
    }

    $courses = $query->with(['sector', 'country', 'category'])
                    ->paginate(12)
                    ->appends($request->all());

    // Dropdown filter options
    $sectors = Sector::where('status', 1)->where('type', 2)->get();
    $countries = Country::where('status', 1)->get();
    $categories = Category::where('type', 6)->get();

    return view('web.globalcourse', compact('courses', 'sectors', 'countries', 'categories'));
}
    public function course(Request $request)
    {
        $query = Course::query();

        $query = $query->where('status',1);

        // 🔍 Search filter (by title or description)
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('short_description', 'like', "%$search%");
            });
        }

        // Language filter
        if ($request->has('languages') && !empty($request->languages)) {
            $query->where(function($q) use ($request) {
                foreach ($request->languages as $language) {
                    $q->orWhereJsonContains('language', $language);
                }
            });
        }

        // Duration filter - Based on your filter options
        if ($request->has('durations') && !empty($request->durations)) {
            $query->where(function($q) use ($request) {
                foreach ($request->durations as $duration) {
                    switch ($duration) {
                        case '1-3 months':
                            $q->orWhere(function($subQ) {
                                $subQ->where('duration_unit', 'months')
                                    ->whereBetween('duration_number', [1, 3]);
                            });
                            break;

                        case '3-6 months':
                            $q->orWhere(function($subQ) {
                                $subQ->where('duration_unit', 'months')
                                    ->whereBetween('duration_number', [3, 6]);
                            });
                            break;

                        case '6-12 months':
                            $q->orWhere(function($subQ) {
                                $subQ->where('duration_unit', 'months')
                                    ->whereBetween('duration_number', [6, 12]);
                            });
                            break;

                        case '1+ years':
                            $q->orWhere(function($subQ) {
                                $subQ->where(function($q1) {
                                    $q1->where('duration_unit', 'years')
                                    ->where('duration_number', '>=', 1);
                                })->orWhere(function($q2) {
                                    $q2->where('duration_unit', 'months')
                                    ->where('duration_number', '>=', 12);
                                });
                            });
                            break;
                    }
                }
            });
        }

        // Learning Product Type filter
        if ($request->has('product_types') && !empty($request->product_types)) {
            $query->whereIn('learning_product_type', $request->product_types);
        }

        // Price filter
        if ($request->has('prices') && !empty($request->prices)) {
            $query->where(function($q) use ($request) {
                if (in_array('free', $request->prices)) {
                    $q->orWhere('paid_type', 'free');
                }
                if (in_array('paid', $request->prices)) {
                    $q->orWhere('paid_type', 'paid');
                }
            });
        }

        // Sector filter
        if ($request->has('sectors') && !empty($request->sectors)) {
            $sectors = $request->sectors;
            if (is_string($sectors)) {
                 $sectors = explode(',', $sectors);
            }
            $query->whereIn('sector_id', (array)$sectors);
        }

        // Mode of Study filter
        if ($request->has('modes') && !empty($request->modes)) {
            $query->whereIn('mode_of_study', $request->modes);
        }

        // Sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $courses = $query->paginate(10);
        $sectors = Sector::where('type', 1)->get();

        return view('web.course', compact('courses', 'sectors'));
    }

    public function globalcourseDetails(Request $request, $slug)
    {
        // Find Course Record From IntlCourse table with relationships
        $course = IntlCourse::with([
                'country' => function ($q) {
                    $q->select('id', 'name');
                },
                'sector' => function ($q) {
                    $q->select('id', 'name');
                },
                'category' => function ($q) {
                    $q->select('id', 'name');
                }
            ])
            ->where('slug', $slug)
            ->where('publish_status', 1)
            ->firstOrFail();

        // Get other related courses (same sector or category)
        $otherCourses = IntlCourse::where('slug', '!=', $slug)
            ->where('publish_status', 1)
            ->where(function($query) use ($course) {
                $query->where('sector_id', $course->sector_id)
                    ->orWhere('category_id', $course->category_id)
                    ->orWhere('country_id', $course->country_id);
            })
            ->with(['country', 'sector'])
            ->latest()
            ->limit(8)
            ->get();

        return view('web.globalcoursedetails', compact(
            'course',
            'otherCourses'
        ));
    }
    public function courseDetails(Request $request, $slug)
    {
        // Find Course Record From Course table
        $course = Course::where('slug', $slug)->first();

        if (!$course) {
            abort(404);
        }

        // Decode JSON fields for frontend with proper error handling
        $jsonFields = ['language', 'location', 'occupations', 'minimum_education', 'learning_tools', 'topics', 'other_specifications', 'gallery'];

        foreach ($jsonFields as $field) {
            if (!empty($course->$field)) {
                if (is_string($course->$field)) {
                    try {
                        $decoded = json_decode($course->$field, true);
                        $course->$field = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
                    } catch (\Exception $e) {
                        $course->$field = [];
                    }
                }
            } else {
                $course->$field = [];
            }
        }

        // Ensure gallery is always an array
        if (empty($course->gallery) || !is_array($course->gallery)) {
            $course->gallery = [];
        }

        // Get related courses (same sector, exclude current course)
        $relatedCourses = Course::where('sector_id', $course->sector_id)
            ->where('id', '!=', $course->id)
            ->where('status', 1)
            ->latest()
            ->limit(10)
            ->get();

        // Decode JSON fields for related courses
        foreach ($relatedCourses as $relatedCourse) {
            foreach ($jsonFields as $field) {
                if (!empty($relatedCourse->$field)) {
                    if (is_string($relatedCourse->$field)) {
                        try {
                            $decoded = json_decode($relatedCourse->$field, true);
                            $relatedCourse->$field = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
                        } catch (\Exception $e) {
                            $relatedCourse->$field = [];
                        }
                    }
                } else {
                    $relatedCourse->$field = [];
                }
            }
        }

        // Fetch only active banners with image field
        $banners = Banner::where('status', 1)->select('image')->get();

        return view('web.coursedetail', compact('course', 'banners', 'relatedCourses'));
    }

    public function storeInterest(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'organization' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            // Store as enquiry or specific interest model
            // For now, let's use Enquiry model or just return success if email is sent
            // Assuming Enquiry model has dynamic fields or we append to message

            $project = Project::find($request->project_id);
            $fullMessage = "Project Interest: " . $project->title . "\n";
            $fullMessage .= "Organization: " . $request->organization . "\n";
            $fullMessage .= "Message: " . $request->message;

            $enquiry = \App\Models\Enquiry::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => '0000000000', // Placeholder as it might be required
                'type' => 11, // Project Interest
                'message' => $fullMessage,
                'status' => 1,
            ]);

            return response()->json(['success' => true, 'message' => 'Thank you for your interest!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function projects(Request $request) {
        return $this->catalog($request, 'projects');
    }

    public function announcements(Request $request) {
        return $this->catalog($request, 'announcements');
    }

    public function catalog(Request $request, $mode = null)
    {
        $projects = Project::query()->where('status', 1);
        $announcements = Announcement::query()->where('status', 1);

        // 1. Base Scope based on mode (or legacy URL fallback)
        if ($mode === 'projects') {
             // Force only projects
             // No announcements
             $announcements->whereRaw('1=0');
        } elseif ($mode === 'announcements') {
             // Force only announcements
             // No projects
             $projects->whereRaw('1=0');
        }

        // Filter: Category
        if ($request->filled('category_id')) {
            $projects->where('category_id', $request->category_id);
            $announcements->where('category_id', $request->category_id);
        }

        // Filter: Type (Specific Sub-filters)
        if ($request->filled('type')) {
             if ($request->type === 'project_3') {
                // Completed Projects (assuming custom type key)
                $projects->where('stage', 'completed');
             } elseif ($request->type === 'project_1') {
                $projects->where('stage', 'ongoing');
            } elseif ($request->type === 'project_2') {
                $projects->where('stage', 'upcoming');
            } elseif ($request->type === 'announcement_1') {
                $announcements->where('type', 1); // Program
            } elseif ($request->type === 'announcement_2') {
                $announcements->where('type', 2); // Scheme
            }
        }


        // Filter: Search
        if ($request->filled('search')) {
            $projects->where('title', 'like', '%' . $request->search . '%');
            $announcements->where('title', 'like', '%' . $request->search . '%');
        }


        // Fetch and tag type for frontend
        // Only run query if not forced to empty
        $projectResults = collect();
        if ($mode !== 'announcements') {
            $projectResults = $projects->with('category')->get()->map(function ($item) {
                $item->type_label = ucfirst($item->stage);
                $item->item_type = 'project';
                return $item;
            });
        }

        $announcementResults = collect();
        if ($mode !== 'projects') {
             $announcementResults = $announcements->with('category')->get()->map(function ($item) {
                $item->type_label = $item->type == 1 ? 'Program' : 'Scheme';
                $item->item_type = 'announcement';
                return $item;
            });
        }

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
            'categories' => Category::all(),
            'pageType' => $mode
        ]);
    }

    public function blog(Request $request)
    {
        $query = Blog::query()->with('category')->where('status', 1);

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

    public function blogShow($typeSlug, $slug)
    {
        $typeMap = [
            'blog' => 1,
            'news' => 2,
            'collaboration' => 3,
            'training' => 4,
            'research' => 5,
            'case-study' => 6,
            'resource' => 7,
            'csr-initiatives' => 8
        ];

        $typeId = $typeMap[$typeSlug] ?? null;

        // Try to find by type and slug first
        $query = Blog::where('slug', $slug);

        if ($typeId) {
            $blog = (clone $query)->where('type', $typeId)->where('status', 1)->with(['category'])->first();
        } else {
            $blog = null;
        }

        // Fallback: search by slug only (for legacy URLs or type-mismatch)
        if (!$blog) {
            $blog = $query->where('status', 1)->with(['category'])->firstOrFail();
        }

        // Get similar blogs from the same category
        $similars = Blog::where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
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

        // Base query - Show all published events (status != 0 and != 4 if needed, or just status 1,2,3)
        // Assuming status: 0=Draft, 1=Upcoming, 2=Ongoing, 3=Completed, 4=Cancelled
        $events = Activity::query()
            ->whereIn('status', [1, 2, 3]) // Show Upcoming, Ongoing, Completed
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
            $events->whereDate('start_date', '>=', $start_date);
        }
        if ($end_date) {
            $events->whereDate('start_date', '<=', $end_date);
        }

        // Apply sorting
        switch ($sort) {
            case 'date_soonest':
                $events->orderBy('start_date', 'asc');
                break;
            case 'popular':
                // Use max_participants as a proxy for size/popularity if no view count
                $events->orderBy('max_participants', 'desc');
                break;
            case 'newest_first':
            default:
                $events->orderBy('created_at', 'desc');
                break;
        }

        // Get all categories for filter sidebar
        $categories = Category::get();

        // Paginate results (15 items per page)
        $events = $events->paginate(15)->appends($request->all());

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
        // Prepare rules if competition
        $rules = $event->rules;
        if ($event->is_competition && $event->rules) {
             // Try to decode if it looks like JSON, otherwise keep as string
             $decoded = json_decode($event->rules, true);
             if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                 $rules = $decoded;
             }
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

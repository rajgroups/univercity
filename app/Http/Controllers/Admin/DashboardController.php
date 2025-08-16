<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Course;
use App\Models\Project;
use App\Models\Sector;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function getStats()
    {
        $stats = [
            'categories' => [
                'total' => Category::count(),
                'active' => Category::where('status', 1)->count(),
                'inactive' => Category::where('status', 0)->count(),
            ],
            'sectors' => [
                'total' => Sector::count(),
                'active' => Sector::where('status', 1)->count(),
                'inactive' => Sector::where('status', 0)->count(),
            ],
            'courses' => [
                'total' => Course::count(),
                'active' => Course::where('status', 1)->count(),
                'inactive' => Course::where('status', 0)->count(),
            ],
            'projects' => [
                'total' => Project::count(),
                'active' => Project::where('status', 1)->count(),
                'inactive' => Project::where('status', 0)->count(),
            ],
            'blogs' => [
                'total' => Blog::count(),
                'active' => Blog::where('status', 1)->count(),
                'inactive' => Blog::where('status', 0)->count(),
            ],
        ];

        return response()->json($stats);
    }
}

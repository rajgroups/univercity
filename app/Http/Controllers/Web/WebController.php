<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Banner;
use App\Models\Project;
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
}

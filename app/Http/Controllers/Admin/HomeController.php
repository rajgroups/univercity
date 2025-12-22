<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\receipt;
use App\Models\Unit;
use App\Models\Order;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Customers;
use App\Models\Store;
use App\Models\Category;
use App\Models\Sector;
use App\Models\Course;
use App\Models\Project;
use App\Models\Blog;

class HomeController extends Controller
{
    // public function index()
    // {
    //     return view('admin.home');
    // }

    public function index()
    {
          return view('admin.home', [
        'totalCategories' => Category::count(),
        'activeCategories' => Category::where('status', 1)->count(),
        'inactiveCategories' => Category::where('status', 0)->count(),

        'totalSectors' => Sector::count(),
        'activeSectors' => Sector::where('status', 1)->count(),
        'inactiveSectors' => Sector::where('status', 0)->count(),

        'totalCourses' => Course::count(),
        'activeCourses' => Course::where('status', 1)->count(),
        'inactiveCourses' => Course::where('status', 0)->count(),

        'totalProjects' => Project::count(),
        'activeProjects' => Project::where('status', 1)->count(),
        'inactiveProjects' => Project::where('status', 0)->count(),

        'totalBlogs' => Blog::count(),
        'activeBlogs' => Blog::where('status', 1)->count(),
        'inactiveBlogs' => Blog::where('status', 0)->count(),
    ]);
    }

    public function ChangePasswordForm(Request $request){
        return view('admin.password');
    }
    public function ChangePassword(Request $request){
        // dd($request);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        $company = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $company->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $company->password = Hash::make($request->new_password);
        $company->save();
        notyf()->addSuccess('Password successfully changed');
        return back()->with('success', 'Password successfully changed');
    }

    public function showSettingsForm(){

        $siteData = admin::findOrFail(1);
        return view('admin.settings.settings',compact('siteData'));
    }


    public function updateSettings(Request $request){
        // dd($request);

        $validatedData = $request->validate([
            'admin_sign'                    => 'nullable',
            'volunteer_sign'                => 'nullable',
            'logo'                          => 'nullable',
        ]);
        $siteData = admin::findOrFail(1);

        // Update the donation with the validated data
        $updated = $siteData->update($validatedData);
        notyf()->addSuccess('Updated Successfully');
        return back()->withsuccess('Updated Successfully');
    }

}

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
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Customers;
use App\Models\Store;


class HomeController extends Controller
{
    // public function index()
    // {
    //     return view('admin.home');
    // }

    public function index()
    {
            return view('admin.home', [
            // 'totalOrders' => Order::count(),

            'totalCategories' => Category::count(),
            'activeCategories' => Category::where('status', 1)->count(),
            'inactiveCategories' => Category::where('status', 0)->count(),

            'totalSubCategories' => Subcategory::count(),
            'activeSubCategories' => Subcategory::where('status', 1)->count(),
            'inactiveSubCategories' => Subcategory::where('status', 0)->count(),

            'totalProducts' => Product::count(),
            'activeProducts' => Product::where('status', 1)->count(),
            'inactiveProducts' => Product::where('status', 0)->count(),

            'totalCustomers' => Customers::count(),
            'activeCustomers' => Customers::where('status', 1)->count(),
            'inactiveCustomers' => Customers::where('status', 0)->count(),

            'totalStores' => Store::count(),
            'activeStores' => Store::where('status', 1)->count(),
            'inactiveStores' => Store::where('status', 0)->count(),
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

        return back()->with('success', 'Password successfully changed.');
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

        return back()->withsuccess('Updated Successfully');
    }

}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\admin;


class HomeController extends Controller
{

    public function ChangePasswordForm(Request $request){
        return view('admin.settings.password');
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

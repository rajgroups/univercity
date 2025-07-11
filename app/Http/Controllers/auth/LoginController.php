<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // dd('hi');
        return view('Authentication.admin.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email'         => 'required|email',
            'password'      => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email','password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.home');
        }

        $remember = $request->has('remember');
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->except('password'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

}

<?php

namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;




class AdminsController extends Controller
{
  public function viewLogin()
  {
    return view('admin.login');
  }

  public function checkLogin(Request $request)
  {

    $remember_me = $request->has('remember_me') ? true : false;

    if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

      return redirect()->route('admins.dashboard');
    }
    return redirect()->back()->with(['error' => 'error logging in']);
  }

  public function dashboard()
  {
    return view('admin.dashboard');
  }




  public function adminLogout(Request $request)
  {
    // Log out from the admin guard
    Auth::guard('admin')->logout();

    // Invalidate the session
    $request->session()->invalidate();

    // Regenerate the CSRF token
    $request->session()->regenerateToken();

    // Redirect back to the login page
    return redirect()->route('home')->with('status', 'You have been logged out successfully!');
  }
}

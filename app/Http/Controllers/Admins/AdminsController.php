<?php

namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food\Food;
use App\Models\Food\Checkout;
use App\Models\Food\Booking;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;





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
    return redirect()->back()->with(['error' => 'Error logging in!']);
  }

  public function dashboard()
  {

    $foodCount = Food::select()->count();
    $orderCount = Checkout::select()->count();
    $bookingCount = Booking::select()->count();
    $adminCount = Admin::select()->count();
    return view('admin.dashboard', compact('foodCount', 'orderCount', 'bookingCount', 'adminCount'));
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
    return redirect()->route('home');
  }

  public function adminList()
  {


    $admins = Admin::select()->OrderBy('id')->get();

    return view('admin.adminList', compact('admins'));
  }


  public function createAdmin()
  {
    return view('admin.createAdmin');
  }





  public function storeAdmin(Request $request)
  {

    request()->validate([
      'name'        => ['required', 'string', 'max:40', 'regex:/^[\pL\s]+$/u'],
      'email'       => 'required|email|max:40',
      'password'        => 'required|max:80',
    ]);

    $admin = Admin::create(
      [
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make('password'),

      ]
    );

    if ($admin) {
      return redirect()->route('admins.list')->with('success', 'You created an admin succesfully!');
    }
  }
}

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
use Illuminate\Support\Facades\File;




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
      'email'       => 'required|email|max:40|unique:admins,email',
      'password'        => 'required|min:6|max:80',
    ]);

    $admin = Admin::create(
      [
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),

      ]
    );

    if ($admin) {
      return redirect()->route('admins.list')->with('success', 'You created an admin succesfully!');
    }
  }

  public function editAdmin($id)
  {
    $admin = Admin::findOrFail($id);
    return view('admin.editAdmin', compact('admin'));
  }

  public function updateAdmin(Request $request, $id)
  {
    $admin = Admin::findOrFail($id);

    $request->validate([
      'name'        => ['required', 'string', 'max:40', 'regex:/^[\pL\s]+$/u'],
      'email'       => 'required|email|max:40|unique:admins,email,' . $admin->id,
      'password'    => 'nullable|min:6|max:80',
    ]);

    $admin->name = $request->name;
    $admin->email = $request->email;
    if ($request->filled('password')) {
      $admin->password = Hash::make($request->password);
    }
    $admin->save();

    return redirect()->route('admins.list')->with('success', 'Admin updated successfully!');
  }

  public function deleteAdmin($id)
  {
    $admin = Admin::findOrFail($id);
    $admin->delete();
    return redirect()->route('admins.list')->with('delete', 'Admin deleted successfully!');
  }


  // orders
  public function viewOrders()
  {
    $orders = Checkout::select()->OrderBy('id')->get();

    return view('admin.viewOrders', compact('orders'));
  }

  public function editOrder($id)
  {
    $order = Checkout::find($id);


    return view('admin.editOrder', compact('order'));
  }


  public function updateOrder(Request $request, $id)
  {
    $order = Checkout::find($id);
    $order->status = $request->input('status');
    $order->save();


    return redirect()->route('admins.order')->with('success', 'You updated an order succesfully!');
  }

  public function deleteOrder($id)
  {
    $order = Checkout::find($id);
    $order->delete();

    return redirect()->route('admins.order')->with('delete', 'You deleted an order succesfully!');
  }


  //bookings
  public function viewBookings()
  {
    $bookings = Booking::select()->OrderBy('id')->get();

    return view('admin.viewBookings', compact('bookings'));
  }

  public function editBooking($id)
  {
    $booking = Booking::find($id);


    return view('admin.editBooking', compact('booking'));
  }

  public function updateBooking(Request $request, $id)
  {
    $booking = Booking::find($id);
    $booking->status = $request->input('status');
    $booking->save();


    return redirect()->route('admins.bookings')->with('success', 'You updated a booking succesfully!');
  }

  public function deleteBooking($id)
  {
    $order = Booking::find($id);
    $order->delete();

    return redirect()->route('admins.bookings')->with('delete', 'You deleted a booking succesfully!');
  }


  //foods

  public function viewFoods()
  {
    $foods = Food::select()->OrderBy('id')->get();

    return view('admin.viewFoods', compact('foods'));
  }

  public function createFood()
  {

    return view('admin.createFood');
  }

  public function storeFood(Request $request)
  {


    $destinationPath = 'assets/img/';
    $myimage = $request->image->getClientOriginalName();
    $request->image->move(public_path($destinationPath), $myimage);

    $request->validate([
      'name' => 'required|string|max:255',
      'price' => 'required|numeric|min:0',
      'category' => 'required|string|max:255',
      'description' => 'required|string',
      'image' => 'nullable',
    ]);

    $food = Food::create(
      [
        'name' => $request->name,
        'price' => $request->price,
        'category' => $request->category,
        'description' => $request->description,
        'image' => $myimage,
      ]
    );

    if ($food) {
      return redirect()->route('admins.foods')->with('success', 'Food item added succesfully!');
    }
  }

  public function deleteFood($id)
  {
    $food = Food::find($id);
    if (File::exists(public_path('assets/img/' . $food->image))) {
      File::delete(public_path('assets/img/' . $food->image));
    } else {
      //dd('File does not exists.');
    }
    $food->delete();

    return redirect()->route('admins.foods')->with('delete', 'You deleted a food succesfully!');
  }
}

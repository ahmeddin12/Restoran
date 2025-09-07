<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Booking;
use App\Models\Food\Checkout;
use App\Models\Food\Review;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getBookings()
    {
        $allBookings = Booking::where("user_id", Auth::user()->id)->get();

        return view('users.bookings', compact('allBookings'));
    }

    public function getOrders()
    {
        $allOrders = Checkout::where("user_id", Auth::user()->id)->get();

        return view('users.orders', compact('allOrders'));
    }

    public function writeReview()
    {

        return view('users.writeReview');
    }
    public function submitReview(Request $request)
    {
        $request->validate([
            'name'   => ['required', 'string', 'max:40', 'regex:/^[\pL\s]+$/u'],
            'review' => 'required',
        ]);

        $submittingReview = Review::create(
            [
                'name' => $request->name,
                'review' => $request->review,
            ]
        );

        if ($submittingReview) {
            return redirect()->route('home')->with('submitted', 'Your review is submitted succesfully!');
        }
    }
}

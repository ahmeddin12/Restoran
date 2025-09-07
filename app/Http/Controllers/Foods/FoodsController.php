<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Food;
use App\Models\Food\Cart;
use App\Models\Food\Checkout;
use App\Models\Food\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;




class FoodsController extends Controller
{
    public function foodDetails($id)
    {
        $fooditem = Food::find($id);
        $cartVarifying = Cart::where('food_id', $id)->where('user_id', Auth::user()->id)->count();
        return view('foods.food-details', compact('fooditem', 'cartVarifying'));
    }

    public function cart(Request $request, $id)
    {

        $cart = Cart::create(
            [
                'user_id' => $request->user_id,
                'food_id' => $request->food_id,
                'name' => $request->name,
                'image' => $request->image,
                'price' => $request->price
            ]
        );

        if ($cart) {
            return redirect()->route('food.details', $id)->with('success', 'Item added to cart successfully');
        };
    }


    public function displayCartItems()
    {
        $user = Auth::user();
        if ($user) {
            $cartItems = Cart::where('user_id', Auth::user()->id)->get();
            $totalPrice = Cart::where('user_id', Auth::user()->id)->sum('price');
            return view('foods.cart', compact('cartItems', 'totalPrice'));
        } else {
            abort('404');
        }
    }

    public function deleteCartItems($id)
    {

        $deleteItems = Cart::where('user_id', Auth::user()->id)->where('food_id', $id);
        $deleteItems->delete();
        if ($deleteItems) {
            return redirect()->route('food.displayCart')->with('delete', 'Item deleted from cart successfully');
        };
    }


    public function prepareCheckout(Request $request)
    {
        $value = $request->price;

        // store the value in session
        Session::put('price', $value);


        $price = Session::get('price');

        if ($price > 0) {
            if (Session::get('price') == 0) {
                abort('403');
            } else {
                return redirect()->route('foods.checkout', compact('price'));
            }
        }
    }

    public function checkout()
    {
        if (Session::get('price') == 0) {
            abort('403');
        } else {

            return view('foods.checkout');
        }
    }

    public function storeCheckout(Request $request)
    {

        $checkout = Checkout::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'town' => $request->town,
                'country' => $request->country,
                'zipcode' => $request->zipcode,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'user_id' => Auth::user()->id,
                'price' => $request->price,

            ]
        );
        if (Session::get('price') == 0) {
            abort('403');
        } else {

            return redirect()->route('foods.pay');
        }
    }
    public function payWithPaypal()
    {
        if (Session::get('price') == 0) {
            abort('403');
        } else {
            return view('foods.pay');
        }
    }

    public function success()
    {
        $deleteItems = Cart::where('user_id', Auth::user()->id);
        $deleteItems->delete();
        if ($deleteItems) {
            if (Session::get('price') == 0) {
                abort('403');
            } else {

                return redirect()->route('foods.displaySuccess')->with('success', 'You Paid for the Items successfully');
            }
        };
        Session::forget('price');
    }


    public function displaySuccess()
    {
        if (Session::get('price') == 0) {
            abort('403');
        } else {
            return view('foods.success');
        }
    }

    public function bookingTables(Request $request)
    {

        request()->validate([
            'name'        => ['required', 'string', 'max:40', 'regex:/^[\pL\s]+$/u'],
            'email'       => 'required|email|max:40',
            'date'        => 'required|date',
            'num_people'  => 'required|integer',
            'spe_request' => 'required|string',
        ]);

        $currentDate = date('m/d/Y h:i:sa');

        if ($request->date < $currentDate or $request->date == $currentDate) {
            return redirect()->route('home')->with('error', 'Please select a correct date!');
        } else {

            $bookingTable = Booking::create(
                [
                    'user_id' => Auth::user()->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'date' => $request->date,
                    'num_people' => $request->num_people,
                    'spe_request' => $request->spe_request,
                ]
            );
            if ($bookingTable) {
                return redirect()->route('home')->with('booked', 'You booked a table succesfully!');
            }
        }
    }

    public function menu()
    {
        $breakfastFoods = Food::select()->take(4)->where('category', 'Breakfast')->orderBy('id', 'desc')->get();

        $lunchFoods = Food::select()->take(4)->where('category', 'Lunch')->orderBy('id', 'desc')->get();

        $dinnerFoods = Food::select()->take(4)->where('category', 'Dinner')->orderBy('id', 'desc')->get();

        return view('foods.menu', compact('breakfastFoods', 'lunchFoods', 'dinnerFoods'));
    }
}

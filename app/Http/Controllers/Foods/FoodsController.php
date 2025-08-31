<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Food;
use App\Models\Food\Cart;
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
            return redirect()->route('foods.checkout', compact('price'));
        }
    }
}

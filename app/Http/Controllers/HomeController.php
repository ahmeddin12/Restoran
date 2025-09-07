<?php

namespace App\Http\Controllers;

use App\Models\Food\Food;
use App\Models\Food\Review;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breakfastFoods = Food::select()->take(4)->where('category', 'Breakfast')->orderBy('id', 'desc')->get();

        $lunchFoods = Food::select()->take(4)->where('category', 'Lunch')->orderBy('id', 'desc')->get();

        $dinnerFoods = Food::select()->take(4)->where('category', 'Dinner')->orderBy('id', 'desc')->get();

        $reviews = Review::select()->take(4)->get();

        return view('home', compact('breakfastFoods', 'lunchFoods', 'dinnerFoods', 'reviews'));
    }
    public function about()
    {
        return view('about');
    }
}

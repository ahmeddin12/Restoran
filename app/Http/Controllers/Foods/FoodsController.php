<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Food;

class FoodsController extends Controller
{
   public function index()
   {
       $breakfastFoods = Food::select()->take(4)->
       where('category', 'breakfast')->get(); 
       return view('home', compact('breakfastFoods'));   
   }
}

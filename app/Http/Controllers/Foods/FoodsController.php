<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Food;

class FoodsController extends Controller
{
   public function foodDetails($id)
   {
       $fooditem = Food::find($id);
       return view('foods.food-details', compact('fooditem'));   
   }
}

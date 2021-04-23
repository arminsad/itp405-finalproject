<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function index()
    {
        // $foods = Food::all();
        return view('search', [
            'foods' => Food::all(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Favorite;

class FavoritesController extends Controller
{
    public function index_favorites()
    {
        $foods = Favorite::all();
        return view('favorites', [
            'foods' => $foods,
        ]);
    }

    public function add_favorites($food_id)
    {
        $foods = Favorite::all();
        return view('favorites', [
            'foods' => $foods,
        ]);
    }

    public function remove_favorites($food_id)
    {
        $foods = Favorite::all();
        return view('favorites', [
            'foods' => $foods,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index_favorites()
    {
        $foods = Favorite::where('user_id', '=', Auth::user()->id)->get();

        return view('favorites', [
            'foods' => $foods,
        ]);
    }

    public function add_favorites($food_id)
    {
        $food = Food::find($food_id);
        $check = Favorite::where('food_id', '=', $food_id)->first();

        if ($check !== NULL){
            return redirect()
            ->route('result', ['food_id' => $food_id])
            ->with('error', "{$food->name} already exists in Favorites List");
        }
        else{
            $new_fav = new Favorite();
            $new_fav->food_id = $food_id;
            $new_fav->user_id = Auth::user()->id;
            $new_fav->save();

            return redirect()
            ->route('result', ['food_id' => $food_id])
            ->with('success', "Successfully added {$food->name} to Favorites List");
        }
    }

    public function remove_favorites($food_id)
    {
        $food = Favorite::where('food_id', '=', $food_id)->first();
        $food_name = $food->food->name;
        $food->delete();

        return redirect()
        ->route('favorites')
        ->with('success', "Successfully removed {$food_name}");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Gate;
use App\Models\Favorite;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return view('search', [
            'foods' => $foods,
        ]);
    }

    public function result($food_id)
    {
        if($food_id == 0){
            $id = $_GET['foods'];
            $food = Food::find($id);
            $ingredients = $food->ingredients()->orderBy('name')->get();
            return view('result', [
                'food' => $food,
                'ingredients' => $ingredients,
            ]);
        }
        else{
            $id = $food_id;
            $food = Food::find($id);
            $ingredients = $food->ingredients()->get();
            return view('result', [
                'food' => $food,
                'ingredients' => $ingredients,
            ]);
        }

    }

    public function store_food(Request $request)
    {
        $request->validate([
            'food'=> 'required|unique:foods,name|max:50',
        ]);
        $food = new Food();
        $food->name = $request->input('food');
        $food->user_id = Auth::user()->id;
        $food->save();

        return redirect()
        ->route('search')
        ->with('success', "Successfully created {$request->input('food')}");
    }

    public function edit_food($food_id)
    {
        $food = Food::find($food_id);
        if (Gate::denies('edit-food', $food)) {
            abort(403);
        }
        return view('edit_food', [
            'food' => $food,
        ]);

    }

    public function update_food($food_id, Request $request)
    {
        $request->validate([
            'food' => 'required|unique:foods,name|max:50',
        ]);

        $input = $request->input('food');
        $food = Food::find($food_id);
        $food->name = $input;
        $food->save();
        if (Gate::denies('edit-food', $food)) {
            abort(403);
        }

        return redirect()
        ->route('result', ['food_id' => $food_id])
        ->with('success', "Successfully created {$input}");
    }

    public function delete_food($food_id)
    {
        $food = Food::find($food_id);
        if (Gate::denies('edit-food', $food)) {
            abort(403);
        }
        $food_name = $food->name;
        $ingredients = $food->ingredients()->get();
        $food->ingredients()->detach();
        foreach($ingredients as $ingredient){
            $ing = Ingredient::find($ingredient->id);
            $check_food = $ing->foods()->where('food_id', '!=', $food_id)->first();
            if ($check_food === NULL){
                $del_ing = Ingredient::find($ingredient->id);
                $del_ing->delete();
            }
        }
        $fav_foods = Favorite::where('food_id', '=', $food_id)->get();
        foreach($fav_foods as $fav_food){
            $fav_food->delete();
        }
        
        $food->delete();
        
        return redirect()
        ->route('search')
        ->with('success', "Successfully deleted {$food_name}");
    }
}

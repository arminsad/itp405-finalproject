<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Gate;

class IngredientController extends Controller
{
    public function add_ingredient($food_id)
    {
        $food = Food::find($food_id);
        if (Gate::denies('edit-food', $food)) {
            abort(403);
        }
        return view('add_ingredient', [
            'food_id' => $food_id,
        ]);
    }

    public function store_ingredient($food_id,Request $request)
    {
        $request->validate([
            'ingredient' => 'required|max:50',
        ]);

        $input = $request->input('ingredient');
        $ingredient = Ingredient::where('name', 'like', $input)->first();
        if($ingredient === NULL){
            $new_ing = new Ingredient();
            $new_ing->name = $input;
            $new_ing->user_id = Auth::user()->id;
            $new_ing->save();

            $food = Food::find($food_id);
            if (Gate::denies('edit-food', $food)) {
                abort(403);
            }
            $food->ingredients()->attach($new_ing->id);

            return view('result', [
                'food' => $food,
                'ingredients' => $food->ingredients()->get(),
            ])
            ->with('success', "Successfully added {$input}");
        }
        else{
            $food = Food::find($food_id);
            if (Gate::denies('edit-food', $food)) {
                abort(403);
            }
            $food->ingredients()->attach($ingredient->id);

            return view('result', [
                'food' => $food,
                'ingredients' => $food->ingredients()->get(),
            ])
            ->with('success', "Successfully added {$ingredient->name}");
        }
    }

    public function edit_ingredient($food_id, $ing_id)
    {
        $food = Food::find($food_id);
        $ingredient = $food->ingredients()->where('id', '=', $ing_id)->first();
        if (Gate::denies('edit-ingredient', $ingredient)) {
            abort(403);
        }
        return view('edit_ingredient', [
            'food_id' => $food_id,
            'ing_id' => $ing_id,
            'ingredient' => $ingredient,
        ]);
    }

    public function update_ingredient($food_id, $ing_id, Request $request)
    {
        $request->validate([
            'ingredient' => 'required|max:50',
        ]);

        $input = $request->input('ingredient');
        $ingredient = Ingredient::where('name', 'like', $input)->first();
        if (Gate::denies('edit-ingredient', $ingredient)) {
            abort(403);
        }
        if($ingredient === NULL){
            $new_ing = new Ingredient();
            $new_ing->name = $input;
            $new_ing->user_id = Auth::user()->id;
            $new_ing->save();
            $food = Food::find($food_id);

            $food->ingredients()->updateExistingPivot($ing_id, [
                'ingredient_id' => $new_ing->id,
            ]);

            $ingredient_old = $food->ingredients()->where('id', '=', $ing_id)->first();

            if ($ingredient_old === NULL){
                $del_ing = Ingredient::find($ing_id);
                $del_ing->delete();
            }

            return view('result', [
                'food' => $food,
                'ingredients' => $food->ingredients()->get(),
            ])
            ->with('success', "Successfully created {$input}");
        }
        else{
            $food = Food::find($food_id);
            $ingredient_old = $food->ingredients()->where('id', '=', $ing_id)->first();
            $old_name = $ingredient_old->name;

            $food->ingredients()->updateExistingPivot($ing_id, [
                'ingredient_id' => $ingredient->id,
            ]);

            $ing_old = $food->ingredients()->where('id', '=', $ing_id)->first();

            if ($ing_old === NULL){
                $del_ing = Ingredient::find($ing_id);
                $del_ing->delete();
            }

            return view('result', [
                'food' => $food,
                'ingredients' => $food->ingredients()->get(),
            ])
            ->with('success', "Successfully edited {$old_name} to {$input}");
        }
    }

    public function delete_ingredient($food_id, $ing_id)
    {
        $food = Food::find($food_id);
        $ing_name = $food->ingredients()->where('id', '=', $ing_id)->first()->name;
        $food->ingredients()->detach($ing_id);

        $ingredient = $food->ingredients()->where('id', '=', $ing_id)->first();
        if (Gate::denies('edit-ingredient', $ingredient)) {
            abort(403);
        }
        if ($ingredient === NULL){
            $del_ing = Ingredient::find($ing_id);
            $del_ing->delete();
        }
        return view('result', [
            'food' => $food,
            'ingredients' => $food->ingredients()->get(),
        ])
        ->with('success', "Successfully deleted {$ing_name}");
    }
}

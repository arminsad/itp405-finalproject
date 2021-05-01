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
            $food->ingredients()->attach($new_ing->id, ['user_id' => Auth::user()->id]);

            return redirect()
            ->route('result', ['food_id' => $food_id])
            ->with('success', "Successfully added {$input}");
        }
        else{
            $food = Food::find($food_id);
            if (Gate::denies('edit-food', $food)) {
                abort(403);
            }

            $existing = $food->ingredients()->where('ingredient_id', '=', $ingredient->id)->first();
            if($existing !== NULL){
                return redirect()
                ->route('ingredient.add', ['food_id' => $food_id])
                ->with('error', "The ingredient already exists.");
            }
            $food->ingredients()->attach($ingredient->id, ['user_id' => Auth::user()->id]);

            return redirect()
            ->route('result', ['food_id' => $food_id])
            ->with('success', "Successfully added {$ingredient->name}");
        }
    }

    public function edit_ingredient($food_id, $ing_id)
    {
        $food = Food::find($food_id);
        $ingredient = $food->ingredients()->where('id', '=', $ing_id)->first();
        if (Gate::denies('edit-food', $food)) {
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

        if($ingredient === NULL){
            $new_ing = new Ingredient();
            $new_ing->name = $input;
            $new_ing->user_id = Auth::user()->id;
            $new_ing->save();
            $food = Food::find($food_id);
            if (Gate::denies('edit-food', $food)) {
                abort(403);
            }
            $food->ingredients()->updateExistingPivot($ing_id, [
                'ingredient_id' => $new_ing->id,
            ]);

            $ingredient_old = $food->ingredients()->where('id', '=', $ing_id)->first();

            if ($ingredient_old === NULL){
                $del_ing = Ingredient::find($ing_id);
                $del_ing->delete();
            }

            return redirect()
            ->route('result', ['food_id' => $food_id])
            ->with('success', "Successfully created {$input}");
        }
        else{
            $food = Food::find($food_id);
            if (Gate::denies('edit-food', $food)) {
                abort(403);
            }
            $ingredient_old = $food->ingredients()->where('id', '=', $ing_id)->first();
            $old_name = $ingredient_old->name;
            $existing = $food->ingredients()->where('ingredient_id', '=', $ingredient->id)->first();
            if($existing !== NULL){
                return redirect()
                ->route('ingredient.edit', ['food_id' => $food_id, 'ing_id' => $ingredient->id])
                ->with('error', "The ingredient already exists.");
            }
            $food->ingredients()->updateExistingPivot($ing_id, [
                'ingredient_id' => $ingredient->id,
            ]);

            $ing_old = $food->ingredients()->where('id', '=', $ing_id)->first();

            if ($ing_old === NULL){
                $del_ing = Ingredient::find($ing_id);
                $del_ing->delete();
            }

            return redirect()
            ->route('result', ['food_id' => $food_id])
            ->with('success', "Successfully edited {$old_name} to {$input}");
        }
    }

    public function delete_ingredient($food_id, $ing_id)
    {
        $food = Food::find($food_id);
        if (Gate::denies('edit-food', $food)) {
            abort(403);
        }
        $ing_name = $food->ingredients()->where('id', '=', $ing_id)->first()->name;
        $food->ingredients()->detach($ing_id);
        // $flag = 1;

        $ing = Ingredient::find($ing_id);
        $check_food = $ing->foods()->where('food_id', '!=', $food_id)->first();
        if ($check_food === NULL){
            $del_ing = Ingredient::find($ing_id);
            $del_ing->delete();
        }
        

        // $check_foods = Food::all();
        // foreach ($check_foods as $check_food){
        //     $check = $check_food->ingredients()->where('id', '=', $ing_id)->first();
        //     if ($check !== NULL){
        //         // return redirect()
        //         // ->route('result', ['food_id' => $food_id])
        //         // ->with('error', "Successfully deleted {$ing_name}");
        //         $flag = 0;
        //         break;
        //     }
        // }

        // // if ($flag){
        //     $del_ing = Ingredient::find($ing_id);
        //     $del_ing->delete();
        // }

        return redirect()
        ->route('result', ['food_id' => $food_id])
        ->with('success', "Successfully deleted {$ing_name}");
    }
}

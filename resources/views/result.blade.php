@extends('main')

@section('title', $food->name)

@section('content')
    {{-- @if(Auth::check()) --}}
    <a class="btn btn-danger" href= "{{route('food.delete', ['food_id' => $food->id])}}" onclick="return confirm('Are you sure you want to delete \'{{$food->name}}\'?');">
        Delete Food
    </a>
    <a class="btn btn-warning" href= "{{route('food.edit', ['food_id' => $food->id])}}">
        Edit Food Name
    </a>
    <a class="btn btn-success" href= "{{route('ingredient.add', ['food_id' => $food->id])}}">
        Add New Ingredient
    </a>
    {{-- @endif --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ingredient</th>
                @if(Auth::check())
                    <th></th>
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($ingredients as $ingredient)
                <tr>
                    <td>{{$ingredient->name}}</td> 
                    @if(Auth::check())
                    <td>
                        <a class="btn btn-danger" href= "{{route('ingredient.delete', ['food_id' => $food->id, 'ing_id' => $ingredient->id])}}" onclick="return confirm('Are you sure you want to delete \'{{$ingredient->name}}\'?');">
                            Delete
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning" href= "{{route('ingredient.edit', ['food_id' => $food->id, 'ing_id' => $ingredient->id])}}">
                            Edit
                        </a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@extends('main')

@section('title', 'Add New Ingredient')

@section('content')
    <form method="POST" action="{{ route('ingredient.store', ['food_id' => $food_id]) }}">
        @csrf
        <div class="mb-3">
            <label for="ingredient" class="form-label">Ingredient Name</label>
            <input type="text" name="ingredient" id="ingredient" class="form-control" value="{{old('ingredient')}}">
            @error('ingredient')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection
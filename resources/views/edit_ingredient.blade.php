@extends('main')

@section('title')
Editing {{$ingredient->name}}
@endsection

@section('content')
<form action="{{route('ingredient.update', ['food_id' => $food_id, 'ing_id' => $ing_id])}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="ingredient" class="form-label">Name</label>
        <input type="text" name="ingredient" id="ingredient" class="form-control" value="{{old('ingredient', $ingredient->name)}}">
        @error('ingredient')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</form>
@endsection
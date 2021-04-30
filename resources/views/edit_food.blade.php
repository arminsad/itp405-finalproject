@extends('main')

@section('title')
Editing {{$food->name}}
@endsection

@section('content')
<form action="{{route('food.update', ['food_id' => $food->id])}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="food" class="form-label">Name</label>
        <input type="text" name="food" id="food" class="form-control" value="{{old('food', $food->name)}}">
        @error('food')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</form>
@endsection
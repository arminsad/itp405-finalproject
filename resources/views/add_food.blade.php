@extends('main')

@section('title', 'Add New Food')

@section('content')
    <form method="POST" action="{{ route('food.store') }}">
        @csrf
        <div class="mb-3">
            <label for="food" class="form-label">Food Name</label>
            <input type="text" name="food" id="food" class="form-control" value="{{old('food')}}">
            @error('food')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection
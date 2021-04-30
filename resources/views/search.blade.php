@extends('main')

@section('title', 'Search')

@section('content')
    <p>Don't have an account? Please <a href="{{ route('registration.index') }}">register</a>.</p>
    <form method="get" action="{{ route('result') }}">
        @csrf
        <div class="mb-3">
            <label for="foods" class="form-label">Food Name:</label>
            <select id = "foods" name="foods">
                <option value="" selected>-- Choose a Food --</option>
                @foreach($foods as $food)
                    <option value="{{ $food->id }}">
                        {{ $food->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">GET INGREDIENTS</button>
            @if(Auth::check())
                <a class="btn btn-warning" href="{{route('food.add')}}" role="button">ADD FOOD</a>
            @else
                <a class="btn btn-success" href="{{route('auth.login')}}" role="button">SIGN IN TO ADD/EDIT FOODS</a>
            @endif
        </div>
    </form>
@endsection




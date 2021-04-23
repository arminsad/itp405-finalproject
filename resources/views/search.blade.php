@extends('main')

@section('title', 'Search')

@section('content')
    <p>Don't have an account? Please <a href="{{ route('registration.index') }}">register</a>.</p>
    <form method="post" action="{{ route('result') }}">
        @csrf
        <div class="mb-3">
            <label for="foods" class="form-label">Food Name:</label>
            <select id = "foods" name="foods">
                <option value="" selected>-- Choose a Food --</option>
                @foreach($foods as $food)
                    <option value="{{ $food->food_id }}">
                        {{ $food->food_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">GET INGREDIENTS</button>
            @if(Auth::check())
                <div class="btn btn-danger"><a href="{{route('auth.logout')}}">LOGOUT</a></div>
                <div class="btn btn-warning"><a href="{{route('add')}}">ADD FOOD</a></div>
            @else
                <div class="btn btn-success"><a href="{{route('auth.login')}}">ADMIN SIGN IN</a></div>
            @endif
        </div>
    </form>
@endsection




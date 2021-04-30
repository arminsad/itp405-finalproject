@extends('main')

@section('title', 'Favorites List')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Food</th>
                @if(Auth::check())
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($foods as $food)
                <tr>
                    <td>{{$food->food->name}}</td> 
                    @if(Auth::check())
                    <td>
                        <a class="btn btn-danger" href= "{{route('favorites.remove', ['food_id' => $food->foods_id])}}">
                            Remove
                        </a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
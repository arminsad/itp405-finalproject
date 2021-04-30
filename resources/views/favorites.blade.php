@extends('main')

@section('title', 'Favorites List')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Food</th>
                <th>Added At</th>
                @if(Auth::check())
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($foods as $food)
                <tr>
                    <td>{{$food->food->name}}</td> 
                    <td>{{$food->created_at}}</td> 
                    @if(Auth::check())
                    <td>
                        <a class="btn btn-danger" href= "{{route('favorites.remove', ['food_id' => $food->food_id])}}">
                            Remove
                        </a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
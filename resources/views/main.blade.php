<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-12">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a href="{{ route('search')}}" class="nav-link">Ingredient Search</a> 
                    </li>
                    @if (Auth::check())
                        @if (Auth::user()->role->slug == 'user')
                        <li class="nav-item">
                            <a href="{{ route('bookmark')}}" class="nav-link">Bookmark List</a> 
                        </li>
                        @endif
                        <li class="nav-item">
                            <form method="post" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('registration.index')}}" class="nav-link">Register</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth.loginForm')}}" class="btn btn-success">Login</a> 
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-9">
                <header>
                    <h2>@yield('title')</h2>
                </header>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                <main>
                    @if (session("success"))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
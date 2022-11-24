<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name', 'HR_APP')}} || {{$title}} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
        <div class="container">
          <a class="navbar-brand" href="#">{{config('app.name', 'HR_APP')}}</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              @auth
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{$active == 'Home' ? 'active' : ''}}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Selamat Datang, {{auth()->user()->name}}
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li>
                    <form action="{{url('/logout')}}" method="post">
                      @csrf
                      <button type="submit" class="dropdown-item" >Logout</button>
                    </form>
                  </li>
                </ul>
              </li>

              @else
                <li class="nav-item">
                  <a class="nav-link {{$active == 'Login' ? 'active' : ''}}" href="{{ url('/login') }}">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{$active == 'Register' ? 'active' : ''}}" href="{{ url('/register') }}">Register</a>
                </li>
              @endauth
            </ul>
          </div>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

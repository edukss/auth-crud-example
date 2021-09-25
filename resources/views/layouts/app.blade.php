<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('app.css') }}"/>
    
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <title>@yield('title')</title>
  </head>

  <body>
        <nav class="navbar navbar-dark">
            <div class="container-fluid">
                <div class="nav-header mx-2">
                    <a class="navbar-brand ml-4 float-left " href="{{ route('login.index') }}">
                        <img src="https://image.jimcdn.com/app/cms/image/transf/dimension=291x10000:format=png/path/s321c39a3f87b9cc6/image/if10556c398b76543/version/1467307485/galeria-de-web.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    </a>
                    <a class="navbar-brand float-left" href="{{ route('login.index') }}">
                        Omatech Auth & CRUD
                    </a>
                </div>

                <ul class=" text-center mt-2">
                    <!-- si estamos logged mostramos bienvenida y boton de Logout -->
                    @if(auth()->check())
                        <li class="rounded py-1 px-2 userNav">
                            <i class="fas fa-user-circle fa-2x d-inline-block align-middle mx-1 "></i><b class="align-middle text-capitalize">{{ auth()->user()->name }}</b>
                        </li>

                        <!-- si ademas de estar logged somos admin, nos aparece el link para ir al panel de edicion -->
                        @if(auth()->user()->is_admin)
                            <li class="rounded-2 py-1 px-2 fw-bold panel">
                                <a class="py-1 px-2" href="{{ route('admin.index') }}">Panel</a>
                            </li>
                        @endif
                        
                        <!-- boton Logout -->
                        <li class="border border-2 border-white rounded-2 py-1 px-2 fw-bold logout">
                            <a class="py-1 px-2" href="{{ route('login.destroy') }}">Log Out</a>
                        </li>

                    @else
                        <li class=" rounded-2 fw-bold py-1 login">
                            <a class="py-1 px-3" href="{{ route('login.index') }}">Log In</a>
                        </li>
                        <li class="border border-2 border-white rounded-2 fw-bold py-1 register">
                            <a class="py-1 px-2" href="{{ route('register.index') }}">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c9863b7b9b.js" crossorigin="anonymous"></script>
    </body>

</html>
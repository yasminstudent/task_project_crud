<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>{{$pageName}}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/app.css")}}">
    </head>
    <body>
        @if (session('errorMessage'))
            <div class="alert alert-danger">
                {{ session('errorMessage') }}
            </div>
        @endif

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="#">
                    <div>
                        <span class="badge bg-white" style="border-radius: 50%">
                            <img src="{{asset('images/logo.jpg')}}"  width="30" style="border-radius: 50%" />
                        </span>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @yield('activeList')" href="{{route('task.index')}}">Listar Tarefas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('activeSave')" href="{{route('task.create')}}">Criar Tarefa</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container pt-3">
            @yield('content')
        </div>

        <footer class="footer mt-auto py-3" style="background-color: #e3f2fd">
            <div class="container">
                <span class="text-muted">C.R.U.D de tarefas feito por Yasmin Silva.</span>
            </div>
        </footer>

        <script src="{{asset("js/bootstrap.min.js")}}" />
    </body>
</html>

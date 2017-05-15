<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="//{{ Request::getHost() }}/socket.io/socket.io.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/noty/jquery.toast.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">



    <nav class="navbar navbar-inverse bg-primary navbar-toggleable-md navbar-light bg-faded app-head-nav">
        <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/">Profiler</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Главная <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.profile.lists')}}">Профили</a>
                </li>
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.profiles.all')}}">Админ панель</a>
                </li>
                @endrole()


            </ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{route('user.profile.index')}}"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Аккаунт
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{route('user.account.index')}}"><i class="fa fa-user" aria-hidden="true"></i> Аккаунт</a>
                            <a class="dropdown-item" href="{{route('user.profile.index')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Профиль</a>
                            <a class="dropdown-item" href="{{route('account.profile.favorite')}}"><i class="fa fa-heart-o" aria-hidden="true"></i> Закладки</a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Выйти</a>
                        </div>
                    </li>






                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>
                            Вход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}"><i class="fa fa-user-plus"
                                                                            aria-hidden="true"></i> Регистрация</a>
                    </li>
                @endif


            </ul>
        </div>
        </div>
    </nav>

    @yield('content')
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://unpkg.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
<script src="{{ asset('assets/noty/jquery.toast.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/vue"></script>
<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>

<!-- Scripts -->

<script src="{{ asset('js/app.js') }}"></script>
<script>
    var $grid = $('.wrap-grid-profile').masonry({
        // options
        itemSelector: '.profile-item',

    });

    $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
    });

</script>
</body>
</html>

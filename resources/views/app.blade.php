<!DOCTYPE html>
<html ng-app="app" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caderneta de Movimentações</title>

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">

    <link href="{{ asset('/semantic/out/semantic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/movimentacao.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap-toggle/css/bootstrap-toggle.min.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
</head>

<body>

<div class="ui grid" ng-controller="appCtrl">

    <div class="computer tablet only row">
        <div class="ui inverted fixed menu navbar">
            <a href="{{ url('/home') }}" class="brand item">Caderneta</a>

            @if(Auth::user())
                <a href="{{ url(route('client.index')) }}" class="item">Movimentos</a>
            @endif

            <div class="right menu">
                @if(auth()->guest())
                    @if(!Request::is('auth/login'))
                        <a class="ui item" href="{{ url('/auth/login') }}">Login</a>
                    @endif
                    @if(!Request::is('auth/register'))
                        <a class="ui item" href="{{ url('/auth/register') }}">Registrar</a>
                    @endif
                @else
                    <div class="ui dropdown item">{{auth()->user()->name }}
                        <i class="dropdown icon"></i>

                        <div class="menu">
                            <a class="item" href="{{ url('/auth/logout') }}">Logout</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mobile only row">
        <div class="ui fixed inverted navbar menu">
            <div class="left menu open">
                <a href="" class="menu item">
                    <i class="content icon"></i>
                </a>
            </div>
        </div>

        <div class="ui vertical sidebar menu">
            <a href="" class="active item">Caderneta</a>

            <div class="menu">
                @if(auth()->guest())
                    @if(!Request::is('auth/login'))
                        <a class="ui item" href="{{ url('/auth/login') }}">Login</a>
                    @endif
                    @if(!Request::is('auth/register'))
                        <a class="ui item" href="{{ url('/auth/register') }}">Registrar</a>
                    @endif
                @else
                    <div class="menu">
                        <a class="item" href="{{ url('/auth/logout') }}">Logout</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row"></div>

    <div class="row">
        @yield('content')
    </div>
</div>

<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <button class="ui circular facebook icon button">
            <i class="facebook icon"></i>
        </button>
        <button class="ui circular twitter icon button">
            <i class="twitter icon"></i>
        </button>
        <button class="ui circular linkedin icon button">
            <i class="linkedin icon"></i>
        </button>
        <button class="ui circular google plus icon button">
            <i class="google plus icon"></i>
        </button>
        <div class="ui inverted section divider"></div>

        <div class="ui center aligned sizer vertical segment">
            <h2 class="ui small header teal">Desenvolvido e projetado por Glaicon José Peixer</h2>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="{{ asset('/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('/semantic/out/semantic.min.js')}}"></script>
<script src="{{ asset('/js/app.js')}}"></script>

@yield('post-script')

</body>
</html>
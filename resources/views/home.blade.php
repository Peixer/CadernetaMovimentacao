@extends('app')

@section('content')

    <style>
        body {
            background-image: url('{{asset('/img/money.jpg')}} ');
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
    </style>

    <div class="ui very padded  piled segments fluid container">
        <div class="ui segment">
            <h1> Caderneta de Movimentações</h1>
        </div>
        <div class="ui segment">
            <h1 class="text-center">Novo site de controle financeiro</h1>
        </div>
    </div>
@endsection
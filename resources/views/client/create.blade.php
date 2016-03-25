@extends('app')

@section('content')
    <div class="container">
        <h2 class="text-center"> Novo Movimento</h2>

        @include('errors._check')

        {!! Form::open(['route'=>'client.store']) !!}

        @include('client._form')

        <h1 id="parcelas"></h1>

        <div class="form-group">
            {!! Form::submit('Criar movimento',['class'=>'btn btn-primary btn-block']) !!}
        </div>

        {!! Form::close() !!}
    </div>

@endsection()

@section('post-script')
    <script>

        $(document).ready(function () {

            $('#tipoPagto').focusout(function () {

                var value = $(this).val();
                if (value !== undefined) {

                    value = parseInt($(this).val(), 10);
                    var result = '';
                    for (var i = 0; i < value; i++) {

                        result += "<div class='form-group'>  <label for='data'>Data: </label> <input class='form-control'' name='data'' type='date'' value='2016-03-20'' id='data'> </div>";
                    }

                    //$('#parcelas').html(result);
                }

            });
        });

    </script>

@endsection
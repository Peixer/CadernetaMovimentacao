@extends('app')

@section('content')
    <div class="container">
        <h3 class="text-center">Editando: {{$movimento->descricao}}</h3>

        @include('errors._check')

        {!! Form::model($movimento, ['route'=>['client.update',$movimento->id]]) !!}

        @include('client._form')


        <a id="parcelas"></a>


        <div class="form-group">
            {!! Form::submit('Alterar movimento',['class'=>'btn btn-primary btn-block']) !!}
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
                    alert(value);

                    var result = '';
                    for (var i = 0; i < value; i++) {

                        result += "<div class='form-group'> teste </div>"
                    }

                    $('#parcelas').innerHTML = result;
                }
            });
        });

    </script>

@endsection
@extends('app')

@section('content')

    <div class="sixteen wide centered column">

        <div class="ui center aligned container">

            <h2 class="text-center"> Novo Movimento</h2>

            @include('errors._check')

            {!! SemanticForm::open()->post()->action(route('client.store')) !!}

            @include('client._form')

            {!! SemanticForm::submit('Criar movimento') !!}

            {!! SemanticForm::close() !!}

        </div>
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
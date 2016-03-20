@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div id="filtroClass" class="leftSide col-sm-4 col-md-3">

                <div id="filtro">
                    <h2 class="text-center">Filtro</h2>
                    <h4>Tipo de Movimentação: <input type="checkbox" id="toggle" checked data-toggle="toggle"
                                                     data-on="Débito"
                                                     data-off="Crédito"
                                                     data-onstyle="success" data-offstyle="danger"></h4>

                    <h4>Início: <input type="date" name="bday"></h4>
                    <h4>Fim: <input type="date" name="bday"></h4>
                </div>

                <hr>

                <div id="total">
                    <h2 class="text-center">Total</h2>

                    <h1 id="valor" class="text-center">250</h1>

                </div>
            </div>
            <div class="col-sm-8 col-md-6 col-lg-7">
                <div class="container-fluid">
                    <h3>Movimentações</h3>

                    <a href="{{route('client.create')}}" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Novo Movimento
                    </a>
                    <br><br>

                    <table id="tableMovimentacao" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Início</th>
                            <th>Descrição</th>
                            <th>Tipo</th>
                            <th>Total</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($movimentacoes as $movimentacao)
                            <tr class="itemTable" data-edit="{{$movimentacao->id}}">
                                <td id="movimentacaoData"
                                    data-tipo="{{$movimentacao->data}}">{{ $movimentacao->getDateFormated()}}</td>

                                <td>{{$movimentacao->descricao}}</td>

                                <td id="movimentacaoTipo"
                                    data-tipo="{{$movimentacao->tipoCobranca}}">{{$movimentacao->getTipoCobranca()}}</td>

                                <td id="movimentacaoTotal"
                                    data-price="{{$movimentacao->total}}">{{$movimentacao->total}}</td>
                                <td>
                                    <a href="{{ route('client.destroy',['id' =>$movimentacao->id]) }}"
                                       class="btn btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        Excluir</a>
                                </td>
                            </tr>
                        @endforeach()
                        </tbody>

                    </table>

                    {!!  $movimentacoes->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('post-script')

    <script>
        $(document).ready(function () {
            calculateTotal();

            $('#toggle').change(function () {
                calculateTotal($(this).prop('checked'));
            });

            $('.itemTable').click(function () {
                window.location = "{{ URL::to('client/edit/') }}/" + $(this).data('edit');
            })
        });

        function calculateTotal(checked) {
            if (checked === undefined)
                checked = true;

            var total = 0;
            var length = $('table  tbody tr #movimentacaoTotal').length;
            var tr = null;
            var price;
            var qtd;

            for (var i = 0; i < length; i++) {
                tr = $('table tbody tr #movimentacaoTipo').eq(i);
                var tipo = tr.data('tipo');

                if (checked === Boolean(tipo)) {
                    tr = $('table tbody tr #movimentacaoTotal').eq(i);
                    price = parseFloat(tr.data('price'));

                    console.log(price);

                    total += price;
                }
            }

            $('#valor').html(total.toFixed(2));
        }

    </script>


@endsection
@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div id="filtroClass" class="col-sm-4 col-md-3">

                <div id="filtro">
                    <h2 class="text-center">Filtro</h2>
                    <h4>Tipo de Movimentação: <input class="componenteFiltro" type="checkbox" id="toggle" checked
                                                     data-toggle="toggle"
                                                     data-on="Débito"
                                                     data-off="Crédito"
                                                     data-onstyle="success" data-offstyle="danger"></h4>

                    <h4>Início: <input id="dataInicio" type="date" name="bday"></h4>
                    <h4>Fim: <input id="dataFim" type="date" name="bday"></h4>

                </div>

                <hr>

                <div id="total">
                    <h2 class="text-center">Total</h2>

                    <h1 id="textValor" class="text-center">250</h1>

                </div>
            </div>
            <div class="col-sm-8 ">
                <div class="container-fluid">
                    <h3>Movimentos</h3>

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
                            <tr class="itemTable" data-movimentacao="{{$movimentacao}}">
                                <td>{{ $movimentacao->getDateFormated()}}</td>
                                <td>{{$movimentacao->descricao}}</td>
                                <td>{{$movimentacao->getTipoCobranca()}}</td>
                                <td>{{$movimentacao->total}}</td>
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

            $('#dataInicio').change(function () {
                calculateTotal($(this).prop('checked'));
            });

            $('#dataFim').change(function () {
                calculateTotal($(this).prop('checked'));
            });

            $('.itemTable').click(function () {
                window.location = "{{ URL::to('client/edit/') }}/" + $(this).data('movimentacao').id;
            });
        });

        function calculateTotal(checked) {
            if (checked === undefined)
                checked = true;

            var total = 0;
            var length = $('table  tbody tr').length;
            var tr = null;
            var price;

            for (var i = 0; i < length; i++) {
                tr = $('table tbody .itemTable').eq(i);

                var movimentacao = tr.data('movimentacao');
                var tipo = Boolean(parseInt(movimentacao.tipoCobranca));
                var data = movimentacao.data;
                var dataInicio = $('#dataInicio').val();
                var dataFim = $('#dataFim').val();

                if (checked === tipo && deveCalcularItem(data, dataInicio, dataFim)) {
                    console.log('entrou');
                    price = parseFloat(movimentacao.total);

                    console.log(price);

                    total += price;
                }
            }

            $('#textValor').html(total.toFixed(2));
        }

        function deveCalcularItem(data, dataInicio, dataFim) {

            if (dataInicio !== '' && data < dataInicio)
                return false;

            if (dataFim !== '' && data > dataFim)
                return false;

            return true;
        }

    </script>


@endsection
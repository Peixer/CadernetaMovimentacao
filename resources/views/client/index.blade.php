@extends('app')

@section('content')

    <div class="sixteen wide centered column">

        <div class="ui center aligned container">
            <table class="ui selectable celled center aligned table green">
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
                <tbody>
                @foreach($movimentacoes as $movimentacao)
                    <tr class="itemTable" data-movimentacao="{{$movimentacao}}">
                        <td><i class="money icon"></i>{{ $movimentacao->getDateFormated()}}</td>
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
            {!! (new Landish\Pagination\SemanticUI($movimentacoes))->render() !!}
        </div>

        <div class="row painel"></div>
    </div>

@endsection()

@section('post-script')

    <script>
        $(document).ready(function () {
            $('.itemTable').click(function () {
                window.location = "{{ URL::to('client/edit/') }}/" + $(this).data('movimentacao').id;
            });
        });
    </script>


@endsection
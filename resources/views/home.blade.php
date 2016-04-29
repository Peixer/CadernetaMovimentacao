@extends('app')

@section('content')
    <div class="ten wide centered column">

        <div class="ui grid">
            <div class="computer tablet only row">
                <div class="ui sizer vertical center aligned segment">
                    <div class="ui huge header computer red">Bem vindo ao Caderneta Online</div>
                    <p></p>
                </div>
            </div>

            <div class="mobile only row">
                <div class="ui center aligned container">
                    <div class="ui huge header mobile red">Bem vindo ao Caderneta Online</div>
                    <p></p>
                </div>
            </div>
        </div>

        <div class="ui center aligned container">
            <h1 class="ui header green">Motivos para gerenciar suas economias no Caderneta Online</h1>
        </div>

        <div class="row painel">
            <div class="ui center aligned text container segment segmentVantagem">
                <h2 class="ui header green">Deixe suas contas 100% online</h2>
            </div>
        </div>

        <div class="row painel">
            <div class="ui center aligned text container segment segmentVantagem">
                <h2 class="ui header red">Tire relatórios em qualquer lugar</h2>
            </div>
        </div>

        <div class="row painel">
            <div class="ui center aligned text container segment segmentVantagem">
                <h2 class="ui header black">Tenha acesso a diversas funcionalides</h2>
            </div>
        </div>

        <div class="row painel"></div>

        <div class="row painel">
            <div class="ui center aligned container">
                <div class="ui huge header mobile red">
                    <div class="content">
                        Caderneta Online
                        <div class="sub header black">A melhor ferramenta de controle financeiro
                            <strong>gratuita</strong>!
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row painel"></div>

    </div>


@endsection
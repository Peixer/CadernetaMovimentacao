@extends('app')

@section('content')

    <div class="sixteen wide centered column" ng-controller="reportCtrl">

        <div class="ui center aligned container">
            <div class="ui raised segments">
                <div class="ui segment">

                    <div class="ui form">
                        <div class="two fields">
                            <div class="field">
                                <label>Início</label>

                                <div class="ui calendar" id="rangestart">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" placeholder="Início">
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Fim</label>

                                <div class="ui calendar" id="rangeend">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" placeholder="Fim">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="ui form">
                        <div class="two fields">
                            <div class="field">
                                <div class="ui tag labels">
                                </div>
                            </div>

                            <div class="field">
                                <div class="ui right labeled left icon input">
                                    <i class="tags icon"></i>
                                    <input ng-model="tag" type="text" placeholder="Digite TAG">
                                    <a class="ui tag label" ng-click="addTag()">
                                        Add Tag
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <hr>

                    <button class="fluid ui button" ng-click="filter()">Filtrar</button>

                </div>
            </div>
        </div>

        <div id="movimentacoes" class="ui center aligned container">
            <canvas id="canvas"></canvas>
        </div>
    </div>

@endsection()


@section('post-script')
    <link href="https://rawgit.com/mdehoog/Semantic-UI/calendar-dist/dist/semantic.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://rawgit.com/mdehoog/Semantic-UI/calendar-dist/dist/semantic.min.js"></script>

    <script>
        function remover(number) {
            $('#label' + number).remove();
        }
    </script>
@endsection()

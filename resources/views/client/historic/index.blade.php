@extends('app')

@section('content')

    <div class="sixteen wide centered column" ng-controller="historicCtrl">

        <div class="ui center aligned container">
            <div class="ui floating dropdown labeled search icon button">
                <i class="filter icon"></i>
                <span class="text">Meses</span>

                <div class="menu">
                    <div class="item" ng-repeat="month in months">@{{month}}</div>
                </div>
            </div>
        </div>

        <div id="movimentacoes" class="ui center aligned container">
            <canvas id="canvas"></canvas>
        </div>
    </div>

@endsection()

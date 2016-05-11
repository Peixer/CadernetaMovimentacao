@extends('app')

@section('content')

    <div class="sixteen wide centered column" ng-controller="registerCtrl">
        <div class="ui grid">
            <div class="computer only row">
                <div class="six wide centered column">
                    <div class="ui center aligned container">

                        <h2 class="text-center">Registrar</h2>

                        {!! SemanticForm::open()->post()->action(url('/auth/register')) !!}

                        <div class="ui stacked segment">
                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="user icon"></i>
                                    <input type="text" placeholder="Digite seu nome" name="name"
                                           value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="mail outline icon"></i>
                                    <input type="email" placeholder="Digite seu email" name="email"
                                           value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="lock icon"></i>
                                    <input type="password" placeholder="Digite a sua senha" name="password">
                                </div>
                            </div>

                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="lock icon"></i>
                                    <input type="password" placeholder="Digite novamente a senha"
                                           name="password_confirmation">
                                </div>
                            </div>

                            {!! SemanticForm::submit('Registrar')->addClass('fluid large teal') !!}
                        </div>

                        <div class="ui error message">
                            @if (count($errors) > 0)
                                <ul class="list">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        {!! SemanticForm::close() !!}

                    </div>
                </div>
            </div>

            <div class="mobile tablet only row">
                <div class="sixteen wide centered column">
                    <div class="ui center aligned container">

                        <h2 class="text-center">Registrar</h2>

                        {!! SemanticForm::open()->post()->action(url('/auth/register')) !!}

                        <div class="ui stacked segment">
                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="user icon"></i>
                                    <input type="text" placeholder="Digite seu nome" name="name"
                                           value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="mail outline icon"></i>
                                    <input type="email" placeholder="Digite seu email" name="email"
                                           value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="lock icon"></i>
                                    <input type="password" placeholder="Digite a sua senha" name="password">
                                </div>
                            </div>

                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="lock icon"></i>
                                    <input type="password" placeholder="Digite novamente a senha"
                                           name="password_confirmation">
                                </div>
                            </div>

                            {!! SemanticForm::submit('Registrar')->addClass('fluid large teal') !!}
                        </div>

                        <div class="ui error message">
                            @if (count($errors) > 0)
                                <ul class="list">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        {!! SemanticForm::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row espacamentoMedio"></div>

        <div class="row espacamentoMedio"></div>

        <div class="row espacamentoMedio"></div>

        <div class="row painel"></div>
    </div>
@endsection

@extends('app')

@section('content')

    <div id="login" class="sixteen wide centered column" ng-controller="loginCtrl">

        <div class="ui grid">
            <div class="computer only row">
                <div class="six wide centered column">
                    <div class="ui center aligned container">

                        <button class="ui fluid large facebook button">
                            <i class="facebook icon"></i>
                            Facebook
                        </button>

                        <div class="ui horizontal divider">
                            Ou
                        </div>

                        <form class="ui form" role="form" method="POST" action="{{ url('/auth/login') }}">
                            {!! csrf_field() !!}
                            <div class="ui stacked segment">
                                <div class="field">
                                    <div class="ui left icon input">
                                        <i class="user icon"></i>
                                        <input type="text" name="email" placeholder="Digite seu e-mail">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui left icon input">
                                        <i class="lock icon"></i>
                                        <input type="password" name="password"
                                               placeholder="Digite sua senha">
                                    </div>
                                </div>
                                <div class="ui fluid large teal submit button">Entrar</div>
                            </div>

                            <div class="ui error message"></div>
                        </form>

                        <div class="ui message">
                            Você é novo por aqui? <a href="{{ url('/auth/register') }}">Registrar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mobile tablet only row">
                <div class="sixteen wide centered column">

                    <div class="ui center aligned container">

                        <button class="ui fluid large facebook button">
                            <i class="facebook icon"></i>
                            Facebook
                        </button>

                        <div class="ui horizontal divider">
                            Ou
                        </div>

                        <form class="ui form" role="form" method="POST" action="{{ url('/auth/login') }}">
                            {!! csrf_field() !!}
                            <div class="ui stacked segment">
                                <div class="field">
                                    <div class="ui left icon input">
                                        <i class="user icon"></i>
                                        <input type="text" name="email" placeholder="Digite seu e-mail">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui left icon input">
                                        <i class="lock icon"></i>
                                        <input type="password" name="password"
                                               placeholder="Digite sua senha">
                                    </div>
                                </div>
                                <div class="ui fluid large teal submit button">Entrar</div>
                            </div>

                            <div class="ui error message"></div>
                        </form>

                        <div class="ui message">
                            Você é novo por aqui? <a href="#/register">Registrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!--
    {{ url('/auth/register') }}
            <a class="btn btn-link" href="{{ url('/password/email') }}">Esqueceu sua senha?</a>
-->

@endsection

@section('post-script')
    <script>
        $(document).ready(function () {
            $('.facebook.button').click(function () {
                window.location = "{{ URL::to('auth/facebook') }}";
            });
        });
    </script>
@endsection
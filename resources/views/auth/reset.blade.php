@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Redefinir Senha</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Existe algum problema com seus dados.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Endereço de E-Mail</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Digite seu email" name="email"
                                           value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Senha</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" placeholder="Digite sua senha"
                                           name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirme Senha</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" placeholder="Digite novamente a senha"
                                           name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Redefinir Senha
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Login</div>
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

						<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
							{!! csrf_field() !!}

							<div class="form-group">
								<label class="col-md-4 control-label">Endereço de E-Mail</label>
								<div class="col-md-6">
									<input type="email" class="form-control" placeholder="Digite seu email" name="email" value="{{ old('email') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Senha</label>
								<div class="col-md-6">
									<input type="password" class="form-control" placeholder="Digite sua senha" name="password">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember">Lembre de mim
										</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">Entrar</button>

									<a class="btn btn-link" href="{{ url('/password/email') }}">Esqueceu sua senha?</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

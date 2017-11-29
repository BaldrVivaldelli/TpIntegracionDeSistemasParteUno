					@extends('layouts.app')
					
					@section('content')
	<body>
<!-- Encabezado de la pagina -->
		<header> 
			<div id="headercont">
				<span class ="sesion"> 
					@if (Auth::check())
					<a class ="userOption" href="/logout">Cerrar sesion</a>
					
				</span>
                    
				<span> 
					<h1>Chelito database</h1>
					@else
					<h1>Bienvenido para acceder al contenido logueate o registrate si no tenes cuenta</h1>
				</span>
				<div class="panel-body">
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					@if (Auth::check())
                    	Ya estas logueado. Bienvenido {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}

					@endif
                </div>
			</div>
		</header>

<!-- Barra Izquierda -->
		@if (Auth::check())
		<div id="panelIzq">
			<div id="panelTit"> 
				<h1>Titulo</h1>
			</div>
			<div id="panelCont"> 
				<ul>
				    <li><a href="">Home</a>  </li>
					<li><a href="" class="panelLins">Personal</a> </li>
					<li><a href="" id ="archivosCompartidos">Archivos Compartidos</a>  </li>
					<li><a href="">Configuracion</a> </li>
					<li><a href="">Cuenta</a> </li>
					<li><a href="">Salir</a> </li>

				</ul>
			</div>
		</div>
		@endif
<div id="prinAf"> 
			<div id="prin"> 

					
					
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div class="panel panel-default">
									<div class="panel-heading">Reset Password</div>
					
									<div class="panel-body">
										<form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
											{{ csrf_field() }}
					
											<input type="hidden" name="token" value="{{ $token }}">
					
											<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
												<label for="email" class="col-md-4 control-label">E-Mail Address</label>
					
												<div class="col-md-6">
													<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
					
													@if ($errors->has('email'))
														<span class="help-block">
															<strong>{{ $errors->first('email') }}</strong>
														</span>
													@endif
												</div>
											</div>
					
											<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
												<label for="password" class="col-md-4 control-label">Password</label>
					
												<div class="col-md-6">
													<input id="password" type="password" class="form-control" name="password" required>
					
													@if ($errors->has('password'))
														<span class="help-block">
															<strong>{{ $errors->first('password') }}</strong>
														</span>
													@endif
												</div>
											</div>
					
											<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
												<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
												<div class="col-md-6">
													<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
					
													@if ($errors->has('password_confirmation'))
														<span class="help-block">
															<strong>{{ $errors->first('password_confirmation') }}</strong>
														</span>
													@endif
												</div>
											</div>
					
											<div class="form-group">
												<div class="col-md-6 col-md-offset-4">
													<button type="submit" class="btn btn-primary">
														Reset Password
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
			</div>
		</div>
	<!-- Aca se termina el contenido de la pagina -->
		</div>
<!-- Contenido Fin-->		
	</body>
    

</html>

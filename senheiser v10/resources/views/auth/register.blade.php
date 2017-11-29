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
											<div class="panel-heading">Registrate</div>
							
											<div class="panel-body">
												<form class="form-horizontal" method="POST" action="{{ route('register') }}">
													{{ csrf_field() }}
							
													<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
														<label for="name" class="col-md-4 control-label">Nombre</label>
							
														<div class="col-md-6">
															<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
							
															@if ($errors->has('name'))
																<span class="help-block">
																	<strong>{{ $errors->first('name') }}</strong>
																</span>
															@endif
														</div>
													</div>
							
													<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
														<label for="email" class="col-md-4 control-label">E-Mail</label>
							
														<div class="col-md-6">
															<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
							
															@if ($errors->has('email'))
																<span class="help-block">
																	<strong>{{ $errors->first('email') }}</strong>
																</span>
															@endif
														</div>
													</div>
							
													<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
														<label for="password" class="col-md-4 control-label">Contraseña</label>
							
														<div class="col-md-6">
															<input id="password" type="password" class="form-control" name="password" required>
							
															@if ($errors->has('password'))
																<span class="help-block">
																	<strong>{{ $errors->first('password') }}</strong>
																</span>
															@endif
														</div>
													</div>
							
													<div class="form-group">
														<label for="password-confirm" class="col-md-4 control-label">Confirma la Contraseña</label>
							
														<div class="col-md-6">
															<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
														</div>
													</div>
							
													<div class="form-group">
														<div class="col-md-6 col-md-offset-4">
															<button type="submit" class="btn btn-primary">
																Registrar
															</button>
															
														</div>
														<a class="btn btn-link" href="/login">
														Ya tenias cuenta? Volve al logueo
														</a>
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

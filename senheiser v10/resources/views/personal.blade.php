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
                    	 Bienvenido {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}

					@endif
                </div>
			</div>
		</header>

<!-- Barra Izquierda -->
		@if (Auth::check())
		<div id="panelIzq">
			<div id="panelTit"> 
				<h1>{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</h1>
			</div>
			<div id="panelCont"> 
				<ul>
				    <li><a href="/home">Home</a>  </li>
					<li><a href="/personal" class="panelLins">Subidos por mi</a> </li>
					<li><a href="" id ="archivosCompartidos">Archivos Compartidos</a>  </li>
					<li><a href="">Configuracion</a> </li>
					<li><a href="">Cuenta</a> </li>
					<li><a href="/logout">Salir</a> </li>

				</ul>
			</div>
		</div>
		@endif
<!-- Contenido -->
		<div id="prinAf"> 
			<div id="prin"> 
	 <!-- Aca se tienen que hacer los cambios de pagina -->
@if (Auth::check())		
				<h3> Titulo de lo que se abra</h3>
				<a href=""id="addProd"> + Agregar nuevo archivo</a>
				<form action="/uploadFile" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input class="subirAch" type="file" name="myFile" required>
					
					<button class="subirBtn" type="submit" name="action">Submit
					<i class="material-icons ">cloud_upload</i>
					</button>
					
					
				</form>
		
				<table id="tablaCont">
					<thead>
						<tr> 
							<th>Eliminar</th>
							<th>Nombre</th>
							<th>Formato</th>
							<th>Peso</th>
							<th>Editar Nombre</th>
							<th>Editar Privacidad</th>
							
						</tr>
					</thead>
					<tbody>
					@foreach ($myFiles as $file)
							<tr>							
							<td>
							<a href="#" onclick="event.preventDefault(); document.getElementById('delete-post-{{$file->id}}').submit();">
								X
							</a>
							<form id="delete-post-{{$file->id}}" action="/deleteFile/{{$file->id}}" method="POST" style="display: none;">
								{{ csrf_field() }}
								<input name="_method" type="hidden" value="DELETE">
							</form>
							</td>
							<td ><a href= "/download/{{$file->id}}" > {{$file->name}} </a> </td>
							<td>{{$file->mime_type}} </td>
							<td>{{$file->size}} </td>
							<td>
								<form class="edit" action="/file/{{$file->id}}"  enctype="multipart/form-data" method="POST">
									{{ csrf_field() }}
									<input type="hidden"  name="_method" value="PUT">
									<input type="textfield" class ="controls" name="name" required>
									<input class="subirBtn" type="submit" value="Editar" >
								</form>
								@if(!$file->public_share)
								<form class="edit"action="/file/{{$file->id}}"  method="POST">
									{{ csrf_field() }}
									<input type="hidden"  name="_method" value="PUT">
									<input type="hidden"  name="public_share" value="1">
									<td><input class="subirBtn"type="submit" value="Publico"></td>
								</form>
								@else
								<form class="edit" action="/file/{{$file->id}}"  method="POST">
									{{ csrf_field() }}
									<input type="hidden"  name="_method" value="PUT">
									<input type="hidden"  name="public_share" value="0">
									<td><input class="subirBtn" type="submit" value="Privado"></td>
								</form>
								@endif
							</td>
							</tr>
						@endforeach	
					</tbody>
				</table>
			</div>
@else
	<!-- Parte para lo que no esta logueado -->
			
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="panel panel-default">
							<div class="panel-heading"> </div>
			
							<div class="panel-body">
								<form class="form-horizontal" method="POST" action="{{ route('login') }}">
									{{ csrf_field() }}
			
									<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
										<label for="email" class="col-md-4 control-label">Direccion de Correo</label>
			
										<div class="col-md-6">
											<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
			
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
										<div class="col-md-6 col-md-offset-4">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
												</label>
											</div>
										</div>
									</div>
			
									<div class="form-group">
										<div class="col-md-8 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Entrar
											</button>
			
											<a class="btn btn-link" href="{{ route('password.request') }}">
												No recordas tu contraseña?
											</a>
										</div>
										<span>No tenes usuario?<a  href="/register">Registrate!</a></span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			@endsection
@endif		
	<!-- Aca se termina el contenido de la pagina -->
		</div>
<!-- Contenido Fin-->		
	</body>
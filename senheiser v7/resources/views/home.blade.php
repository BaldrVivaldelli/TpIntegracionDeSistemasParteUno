@extends('layouts.app')

@section('content')
	<body>
<!-- Encabezado de la pagina -->
		<header> 
			<div id="headercont">
				<span class ="sesion"> 
					@if (Auth::check())
					<a class ="userOption" href="/logout">Cerrar sesion</a>
					@else

					<a class ="userOption" href="/login">Iniciar sesion</a>
					<a class ="userOption" href="/register">Registrar</a>

					@endif
				</span>
				<span> 
					<h1>Chelito database</h1>
				</span>
				<div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					@if (Auth::check())
                    	You are logged in!

					@endif
                </div>
			</div>
		</header>

<!-- Barra Izquierda -->

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
<!-- Contenido -->
		<div id="prinAf"> 
			<div id="prin"> 
	 <!-- Aca se tienen que hacer los cambios de pagina -->
				<h3> Titulo de lo que se abra</h3>
				<a href=""id="addProd"> + Agregar nuevo archivo</a>
				<form action="/uploadFile" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="file" name="myFile">
					<input type="submit" value="Submit"></input>
				</form>
		
@if (Auth::check())		
				<table id="tablaCont">
					<thead>
						<tr> 
							<th>X</th>
							<th>Nombre</th>
							<th>Formato</th>
							<th>Peso</th>
							<th>Editar</th>
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
								<form action="/file/{{$file->id}}"  enctype="multipart/form-data" method="POST">
									{{ csrf_field() }}
									<input type="hidden"  name="_method" value="PUT">
									<input type="textfield" class ="controls" name="name">
									<input type="submit" value="Submit">
								</form>
								@if(!$file->public_share)
								<form action="/file/{{$file->id}}"  method="POST">
									{{ csrf_field() }}
									<input type="hidden"  name="_method" value="PUT">
									<input type="hidden"  name="public_share" value="1">
									<input type="submit" value="Publico">
								</form>
								@else
								<form action="/file/{{$file->id}}"  method="POST">
									{{ csrf_field() }}
									<input type="hidden"  name="_method" value="PUT">
									<input type="hidden"  name="public_share" value="0">
									<input type="submit" value="Privado">
								</form>
								@endif
							</td>
							</tr>
						@endforeach	
					</tbody>
				</table>
@endif		
			</div>
	<!-- Aca se termina el contenido de la pagina -->
		</div>
<!-- Contenido Fin-->		
	</body>
    <script src="js/app.js"></script>

</html>
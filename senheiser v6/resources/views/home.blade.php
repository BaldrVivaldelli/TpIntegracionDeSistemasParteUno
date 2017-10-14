@extends('layouts.app')

@section('content')
<html lang="en-US">
	<head>
		<link rel="stylesheet" type="text/css" href="css/app.css">
		<link rel="icon" href="img/fav.png" type="image/png" >
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<meta charset="UTF-8">
		<title>Chelito DB</title>
	</head>
	<body>
<!-- Encabezado de la pagina -->
		<header> 
			<div id="headercont">
				<span class ="sesion"> 
					<a href="/login">Iniciar sesion</a>
					
					
					<a href="/logout">Cerrar sesion</a>
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

                    You are logged in!
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
				<table id="tablaCont">
					<thead>
						<tr> 
							<th>X</th>
							<th>Nombre</th>
							<th>Formato</th>
							<th>Peso</th>
							<th>Acciones</th>
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
							<a href="">1</a>
								<a href="">2</a>
								<a href="">3</a>
							</td>
							</tr>
						@endforeach	
					</tbody>
				</table>
			</div>
	<!-- Aca se termina el contenido de la pagina -->
		</div>
<!-- Contenido Fin-->		
	</body>
    <script src="js/app.js"></script>
</html>
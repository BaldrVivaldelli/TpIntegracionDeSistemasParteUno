@extends('layouts.app')

@section('homeData')

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
@extends('layouts.app')






@foreach ($detailData as $file)    



<form action="/agregarDetalles" method="post">
  First name:<br>
  <input id ="formDeatalle" type="text" name="firstname" value = {{$file['nombre']}}><br>

<h1>Pone las palabras para hacer la busqueda mas rapida</h1>    
<textarea rows="4" cols="50" form ="formDeatalle">
</textarea>
  <input type="submit">Agregar detalle</input>
</form>
@endforeach	

<a href="/home">volver</a>
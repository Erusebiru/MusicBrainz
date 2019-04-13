@extends('welcome')

@section('content')
    
    <form method="POST" action="/search">
        @csrf
        <h4>Introduce el artista que desees buscar</h4>
        <input type="text" name="searched">
        <input type="submit" value="Buscar">
    </form>
    <br>
    <button onclick="javascript:window.location.href = '/songs'">Canciones</button>
    <button onclick="javascript:window.location.href = '/artists'">Artistas</button>
@stop
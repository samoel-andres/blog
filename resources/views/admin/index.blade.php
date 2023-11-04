@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Bienvenido al panel de administracion</h1>
@stop

@section('content')
    <p>¡Hola! {{ Auth::user()->full_name }} desde aqui puedes administrar tus articulos, categorias y comentarios</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mi Perfil</h1>
    <p>Bienvenido {{ auth()->user()->name }}</p>
</div>
@endsection
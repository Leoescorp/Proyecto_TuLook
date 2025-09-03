@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800">
            Bienvenido {{ Auth::user()->Nombre_Completo }}
        </h1>
        <p class="mt-4 text-gray-600">
            Has iniciado sesión correctamente en TuLook 🎉
        </p>

        <a href="{{ route('tulook.usuario') }}"
   class="mt-6 inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition">
   Ir a la tienda
</a>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuLook</title>
    <!-- Aquí puedes agregar tus enlaces a CSS y scripts globales -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <header class="bg-white shadow">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <!-- Logo o Nombre de tu tienda -->
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800 md:text-2xl">TuLook</a>

            <!-- Lógica para mostrar la navegación de invitado o usuario logueado -->
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="text-white bg-indigo-600 hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Registro</a>
                @endguest

                @auth
                    <a href="{{ route('tulook.usuario') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Perfil</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-900 px-3 py-2 rounded-md text-sm font-medium">Cerrar Sesión</button>
                    </form>
                @endauth
            </div>
        </nav>
    </header>

    <main class="container mx-auto mt-8 px-6 py-4">
        <!-- Aquí es donde se inyectará el contenido específico de cada página -->
        @yield('content')
    </main>

    <!-- Puedes agregar un footer aquí si lo deseas -->

</body>
</html>
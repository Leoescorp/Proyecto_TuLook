
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuLook - Tienda de Ropa Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        #btnSubir {
            position: fixed; bottom: 2rem; right: 2rem;
            background-color: #4f46e5; color: white; padding: 0.75rem;
            border-radius: 9999px; box-shadow: 0 4px 14px rgba(0,0,0,0.15);
            cursor: pointer; transition: 0.3s ease-in-out; opacity: 0;
            transform: translateY(100px); z-index: 50;
        }
        #btnSubir.mostrar { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Barra de navegación -->
    <nav class="bg-white shadow-lg p-4 sticky top-0 z-40 rounded-b-xl">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <img src="https://placehold.co/50x50/4f46e5/ffffff?text=TL" class="rounded-full shadow-md" alt="TuLook Logo">
                <a href="{{ route('tulook.usuario') }}" class="text-2xl font-bold text-gray-900 hover:text-indigo-600">TuLook</a>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('tulook.usuario') }}" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A7.962 7.962 0 0112 15c2.03 0 3.93.82 5.394 2.197a8 8 0 00-10.74 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="hidden sm:block font-medium">Mi Perfil</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full shadow-md">
                            Cerrar Sesión
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full shadow-md">
                        Iniciar Sesión
                    </a>
                @endguest

                <a href="{{ route('carrito.ver') }}" class="relative text-gray-600 hover:text-indigo-600">
                    🛒 Carrito
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <main class="container mx-auto px-4 py-8 flex-grow">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">Productos Disponibles</h1>

        <!-- Buscar -->
        <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
            <form method="GET" action="{{ route('tulook.usuario') }}" class="flex flex-col md:flex-row gap-4 items-center">
                <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar productos..."
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md">Buscar</button>
                <a href="{{ route('tulook.usuario') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-md">Limpiar</a>
            </form>
        </div>

        <!-- Filtros -->
        <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
            <form method="GET" action="{{ route('tulook.usuario') }}" class="flex flex-col md:flex-row gap-4 items-center">
                <select name="categoria" class="w-full px-4 py-2 border rounded-md">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->N_Categoria }}" {{ request('categoria') == $cat->N_Categoria ? 'selected' : '' }}>
                            {{ $cat->N_Categoria }}
                        </option>
                    @endforeach
                </select>
                <select name="subcategoria" class="w-full px-4 py-2 border rounded-md">
                    <option value="">Todas las subcategorías</option>
                    @foreach($subcategorias as $sub)
                        <option value="{{ $sub->SubCategoria }}" {{ request('subcategoria') == $sub->SubCategoria ? 'selected' : '' }}>
                            {{ $sub->SubCategoria }}
                        </option>
                    @endforeach
                </select>
                <select name="genero" class="w-full px-4 py-2 border rounded-md">
                    <option value="">Todos los géneros</option>
                    @foreach($generos as $gen)
                        <option value="{{ $gen->N_Genero }}" {{ request('genero') == $gen->N_Genero ? 'selected' : '' }}>
                            {{ $gen->N_Genero }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md">Filtrar</button>
            </form>
        </div>

        <!-- Productos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($articulos as $articulo)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:scale-105 transform transition">
                    <img src="{{ asset($articulo->Foto) }}" alt="{{ $articulo->N_Articulo }}" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h5 class="text-xl font-bold">{{ $articulo->N_Articulo }}</h5>
                        <p class="text-sm text-gray-600">{{ $articulo->categoria->N_Categoria ?? '' }}</p>
                        <p class="text-2xl font-bold mt-2">${{ number_format($articulo->precio->Valor ?? 0, 0, ',', '.') }}</p>
                        <a href="{{ route('TuLook.detalle', $articulo->ID_Articulo) }}" class="mt-3 inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 font-semibold">No se encontraron productos</div>
            @endforelse
        </div>
    </main>

    <!-- Botón subir -->
    <button id="btnSubir" title="Ir al inicio">
        ⬆
    </button>

    <footer class="mt-auto">
        <div class="bg-gray-800 text-white p-6 text-center">&copy; 2025 TuLook. Todos los derechos reservados.</div>
    </footer>

    <script>
        const btnSubir = document.getElementById('btnSubir');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) btnSubir.classList.add('mostrar'); else btnSubir.classList.remove('mostrar');
        });
        btnSubir.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    </script>
</body>
</html>

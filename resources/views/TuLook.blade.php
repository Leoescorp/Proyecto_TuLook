<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuLook</title>
    <!-- Usa Tailwind CSS para un diseño limpio y moderno -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        /* Estilos para el botón de "Volver Arriba" */
        #btnSubir {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background-color: #4f46e5;
            color: white;
            padding: 0.75rem;
            border-radius: 9999px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            opacity: 0;
            transform: translateY(100px);
            z-index: 50;
        }
        #btnSubir.mostrar {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <!-- Barra de navegación principal -->
    <nav class="bg-white shadow-lg p-4 sticky top-0 z-40 rounded-b-xl">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <!-- Logo -->
                <img src="https://placehold.co/50x50/4f46e5/ffffff?text=TL" alt="TuLook Logo" class="rounded-full shadow-md">
                <a class="text-2xl font-bold text-gray-900 hover:text-indigo-600 transition-colors" href="{{ route('TuLook') }}">TuLook</a>
            </div>

            <!-- Solo botones de login y registro -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full transition-colors shadow-md">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="border border-indigo-600 text-indigo-600 font-bold py-2 px-4 rounded-full transition-colors hover:bg-indigo-50 shadow-md">
                    Registrarse
                </a>

                <!-- Enlace al carrito -->
                <a href="{{ route('carrito.ver') }}" class="relative text-gray-600 hover:text-indigo-600 transition-colors">
                    🛒 Carrito
                    @if(count(Session::get('carrito', [])) > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                            {{ count(Session::get('carrito', [])) }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <!-- Resto del cuerpo de la página -->
    <div class="Tienda container mx-auto px-4 py-8">
        <h1 class="Titulo text-4xl font-extrabold text-gray-800 mb-6 text-center">Productos Disponibles</h1>
        
        <!-- Buscar productos -->
        <div class="Buscar-Articulo bg-white p-6 rounded-xl shadow-lg mb-8">
            <form method="GET" action="{{ route('TuLook') }}" class="flex flex-col md:flex-row gap-4 items-center">
                <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar productos..." class="Buscador w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit" class="Boton-Buscar w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md transition-colors shadow-md">Buscar</button>
                <a href="{{ route('TuLook') }}" class="Boton-Limpiar w-full md:w-auto bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-md transition-colors shadow-md">Limpiar</a>
            </form>
        </div>

        <!-- Filtros -->
        <div class="Filtro bg-white p-6 rounded-xl shadow-lg mb-8">
            <div class="Filtracion">
                <form method="GET" action="{{ route('TuLook') }}" class="Formulario-Filtro flex flex-col md:flex-row gap-4 items-center">
                    <div class="Seleccion w-full">
                        <select name="categoria" class="Form_Seleccion w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Todas las categorías</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->N_Categoria }}" {{ request('categoria') == $categoria->N_Categoria ? 'selected' : '' }}>
                                    {{ $categoria->N_Categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Seleccion w-full">
                        <select name="subcategoria" class="Form_Seleccion w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Todas las subcategorías</option>
                            @foreach($subcategorias as $subcategoria)
                                <option value="{{ $subcategoria->SubCategoria }}" {{ request('subcategoria') == $subcategoria->SubCategoria ? 'selected' : '' }}>
                                    {{ $subcategoria->SubCategoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Seleccion w-full">
                        <select name="genero" class="Form_Seleccion w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Todos los géneros</option>
                            @foreach($generos as $genero)
                                <option value="{{ $genero->N_Genero }}" {{ request('genero') == $genero->N_Genero ? 'selected' : '' }}>
                                    {{ $genero->N_Genero }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Seleccion w-full md:w-auto">
                        <button type="submit" class="Boton-Filtrar w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md transition-colors shadow-md">Filtrar</button>
                        <a href="{{ route('TuLook') }}" class="Boton-Limpiar w-full md:w-auto bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-md transition-colors shadow-md">Limpiar</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listado de Productos -->
        <div class="Articulos grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($articulos as $articulo)
                <div class="Articulo-Contenido bg-white rounded-xl shadow-lg overflow-hidden transform transition-transform hover:scale-105">
                    <div class="Articulo">
                        <img src="{{ asset($articulo->Foto) }}" class="Img-Articulo w-full h-64 object-cover" alt="{{ $articulo->N_Articulo }}">
                        <div class="Descripcion-Articulo p-6">
                            <div class="Categoria-Genero flex justify-between items-center mb-2">
                                <span class="Categoria-Articulo text-xs font-semibold text-gray-500">{{ $articulo->categoria->N_Categoria }}</span>
                                <span class="Genero-Articulo text-xs font-semibold text-gray-500">{{ $articulo->genero->N_Genero }}</span>
                            </div>
                            <h5 class="Nombre-Articulo text-xl font-bold text-gray-900 mb-1 truncate">{{ $articulo->N_Articulo }}</h5>
                            <p class="SubCategoria-Articulo text-sm text-gray-600 mb-2 truncate">{{ $articulo->subcategoria->SubCategoria }}</p>
                            <p class="Precio-Articulo text-2xl font-bold text-gray-800 mb-4">${{ number_format($articulo->precio->Valor, 0, ',', '.') }}</p>
                            @php
                                $hayStock = $articulo->productos->sum('Cantidad') > 0;
                            @endphp
                            <p class="{{ $hayStock ? 'text-green-500' : 'text-red-500' }} font-bold mb-4">
                                {{ $hayStock ? 'En stock' : 'Agotado' }}
                            </p>
                            <div class="Detalles">
                                <a href="{{ route('TuLook.detalle', $articulo->ID_Articulo) }}" class="Ver-Detalles block text-center mt-4 bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-900 transition-colors shadow-md">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="Mensaje-No-Resultados col-span-full">
                    <div class="Alerta-No-Articulos text-center text-gray-500 text-lg font-semibold mt-12">
                        No se encontraron productos con los filtros seleccionados
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Botón de subir con Tailwind y SVG -->
    <button id="btnSubir" title="Ir al inicio" aria-label="Volver al inicio de la página">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
    
    <footer>
        <div class="Pie-Pagina bg-gray-800 text-white p-6 mt-8">
            <div class="container mx-auto text-center">
                <p>&copy; 2025 TuLook. Todos los derechos reservados a los creadores.</p>
            </div>
        </div>
    </footer>

</body>
    <script>
        // Muestra/oculta el botón de subir al hacer scroll
        window.addEventListener('scroll', function() {
            const btnSubir = document.getElementById('btnSubir');
            if (window.scrollY > 300) {
                btnSubir.classList.add('mostrar');
            } else {
                btnSubir.classList.remove('mostrar');
            }
        });

        // Función para subir al inicio con animación suave
        document.getElementById('btnSubir').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</html>

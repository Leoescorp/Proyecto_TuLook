<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuLook</title>
    <link href="{{ asset('css/TuLook.css?v=1') }}" rel="stylesheet">
</head>
<body>

    <!-- Barra de navegación principal -->
    <nav class="Barra-Navegacion">
        <div class="Navegacion">
            <img src="{{ asset('ImgTuLook/TuLook.jpg') }}" alt="TuLook Logo">
            <a class="Titulo-Principal" href="{{ route('TuLook') }}">TuLook</a>

            <div class="nav-buttons">
                <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn-register">Registrarse</a>

                <a href="{{ route('carrito.ver') }}" class="carrito-link">
                    🛒 Carrito
                    @if(count(Session::get('carrito', [])) > 0)
                        <span class="contador-carrito">
                            {{ count(Session::get('carrito', [])) }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <!-- Resto del cuerpo de la página -->
    <div class="Tienda">
        <center> <h1 class="Titulo">Productos Disponibles</h1></center>
        
        <!-- Filtros -->
        <div class="Barra-Busqueda">
            <form method="GET" action="{{ route('TuLook') }}" class="Formulario-Filtro">

                <!-- Buscador -->
                <input type="text" name="buscar" placeholder="Buscar productos..." value="{{ request('buscar') }}">

                <!-- Géneros -->
                <select name="genero">
                    <option value="">Todos los géneros</option>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->N_Genero }}" {{ request('genero') == $genero->N_Genero ? 'selected' : '' }}>
                            {{ $genero->N_Genero }}
                        </option>
                    @endforeach
                </select>

                <!-- Categorías -->
                <select name="categoria">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->N_Categoria }}" {{ request('categoria') == $categoria->N_Categoria ? 'selected' : '' }}>
                            {{ $categoria->N_Categoria }}
                        </option>
                    @endforeach
                </select>

                <!-- Subcategorías -->
                <select name="subcategoria">
                    <option value="">Todas las subcategorías</option>
                    @foreach($subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->SubCategoria }}" {{ request('subcategoria') == $subcategoria->SubCategoria ? 'selected' : '' }}>
                            {{ $subcategoria->SubCategoria }}
                        </option>
                    @endforeach
                </select>

                <!-- Botones -->
                <button type="submit" class="Boton-Buscar">Buscar</button>
                <a href="{{ route('TuLook') }}"><button type="button" class="Boton-Buscar">Limpiar</button></a>
            </form>
        </div>

        <!-- Listado de Productos -->
        <div class="Articulos">
            @forelse($articulos as $articulo)
                <div class="Articulo-Contenido">
                    <div class="Articulo">
                        <br><br>
                        <img src="{{ asset($articulo->Foto) }}" class="Img-Articulo" alt="{{ $articulo->N_Articulo }}">
                        <div class="Descripcion-Articulo">
                            <div class="Categoria-Genero">
                                <span class="Categoria-Articulo">{{ $articulo->categoria->N_Categoria }}</span>
                                <span class="Genero-Articulo">{{ $articulo->genero->N_Genero }}</span>
                            </div>
                            <h5 class="Nombre-Articulo">{{ $articulo->N_Articulo }}</h5>
                            <p class="SubCategoria-Articulo">{{ $articulo->subcategoria->SubCategoria }}</p>
                            <p class="Precio-Articulo">${{ number_format($articulo->precio->Valor, 0, ',', '.') }}</p>
                            @php
                                // Verifica si hay stock disponible
                                $hayStock = $articulo->productos->sum('Cantidad') > 0;
                            @endphp
                            <p class="{{ $hayStock ? 'text-success' : 'text-danger' }}">
                                {{ $hayStock ? 'En stock' : 'Agotado' }}
                            </p>
                        </div>
                        <div class="Detalles">
                            <a href="{{ route('TuLook.detalle', $articulo->ID_Articulo) }}" class="Ver-Detalles">Ver Detalles</a>
                        </div><br>
                    </div>
                </div>
            @empty
                <div class="Mensaje-No-Resultados">
                    <div class="Alerta-No-Articulos">
                        No se encontraron productos con los filtros seleccionados
                    </div>
                </div>
            @endforelse
        </div>

    <button id="btnSubir" class="boton-subir" title="Ir al inicio" aria-label="Volver al inicio de la página">
        <img src="{{ asset('ImgTuLook/Arriba.png') }}" alt="Subir" class="icono-subir">
    </button>

        <!-- Pie de página -->
    <footer>
        <div class="Pie-Pagina">
            <div class="Derechos">
                <div class="Texto-Derechos">
                    <p>&copy; 2025 TuLook. Todos los derechos reservados a los creadores.</p>
                </div>
            </div>
        </div>
    </footer>

</body>
    <script>
        // Mostrar/ocultar botón al hacer scroll
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
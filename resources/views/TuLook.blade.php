<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuLook</title>
    <link href="{{ asset('css/TuLook.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="Barra-Navegacion">
        <div class="Navegacion">
            <img src="{{ asset('ImgTuLook/TuLook.jpg') }}" alt="TuLook">
            <a class="Titulo-Principal" href="{{ route('TuLook') }}">TuLook</a>

            <a href="{{ route('carrito.ver') }}" class="carrito-link">
                🛒 Carrito 
                @if(count(Session::get('carrito', [])) > 0)
                    <span class="contador-carrito">
                        {{ count(Session::get('carrito', [])) }}
                    </span>
                @endif
            </a>
        </div>
    </nav>

    <div class="Tienda">
        <h1 class="Titulo">Productos Disponibles</h1>
        
        <!--Buscar productos-->
        <div class="Buscar-Articulo">
            <form method="GET" action="{{ route('TuLook') }}">
                <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar productos..." class="Buscador">
                <button type="submit" class="Boton-Buscar">Buscar</button>
                    <a href="{{ route('TuLook') }}" class="Boton-Limpiar">Limpiar</a>
            </form>
        </div>

        <!-- Filtros -->
        <div class="Filtro">
            <div class="Filtracion">
                <form method="GET" action="{{ route('TuLook') }}" class="Formulario-Filtro">
                    <div class="Seleccion">
                        <select name="categoria" class="Form_Seleccion">
                            <option value="">Todas las categorías</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->N_Categoria }}" {{ request('categoria') == $categoria->N_Categoria ? 'Selecionado' : '' }}>
                                    {{ $categoria->N_Categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Seleccion">
                        <select name="subcategoria" class="Form_Seleccion">
                            <option value="">Todas las subcategorías</option>
                            @foreach($subcategorias as $subcategoria)
                                <option value="{{ $subcategoria->SubCategoria }}" {{ request('subcategoria') == $subcategoria->SubCategoria ? 'Selecionado' : '' }}>
                                    {{ $subcategoria->SubCategoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Seleccion">
                        <select name="genero" class="Form_Seleccion">
                            <option value="">Todos los géneros</option>
                            @foreach($generos as $genero)
                                <option value="{{ $genero->N_Genero }}" {{ request('genero') == $genero->N_Genero ? 'Selecionado' : '' }}>
                                    {{ $genero->N_Genero }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Seleccion">
                        <button type="submit" class="Boton-Filtrar">Filtrar</button>
                        <a href="{{ route('TuLook') }}" class="Boton-Limpiar">Limpiar</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listado de Productos -->
        <div class="Articulos">
            @forelse($articulos as $articulo)
                <div class="Articulo-Contenido">
                    <div class="Articulo">
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
                        </div>
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

        <!-- Paginación se boro por estilo -->
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
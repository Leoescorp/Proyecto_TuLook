<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto - TuLook</title>
    <link href="{{ asset('css/TuLook.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
        .color-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .color-circle {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 1px solid #ddd;
            display: inline-block;
        }
        .variante-color {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 1px solid #ddd;
            margin-right: 8px;
        }

        /* 🎨 Botón agregar al carrito */
        .Boton-Agregar-Carrito {
            background: #283593;
            color: #fff;
            padding: 12px 18px;
            border-radius: 6px;
            border: none;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
            width: 100%;
        }
        .Boton-Agregar-Carrito:hover {
            background: #1a237e;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .Boton-Agregar-Carrito:disabled {
            background: #ccc;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* 🎨 Variantes disponibles en cuadrícula */
        #variantes-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 10px;
        }
        .variante-item {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 10px;
            background: #fafafa;
        }

        /* 🎨 Selects */
        select option:disabled {
            color: #aaa;
        }

        /* Contenedor del formulario */
.Formulario-Compra {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    margin-top: 15px;
}

/* Stock general y específico */
.Stock {
    font-size: 1rem;
    margin-bottom: 10px;
    font-weight: bold;
}
.Stock.Disponible {
    color: #28a745; /* verde */
}
.Stock.Agotado {
    color: #dc3545; /* rojo */
}

/* 🔹 Cada selector (color, talla, cantidad) */
.Selector {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}
.Selector label {
    font-weight: 600;
    margin-bottom: 6px;
    color: #333;
}
.Selector select,
.Selector input[type="number"] {
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 0.95rem;
    transition: border 0.3s, box-shadow 0.3s;
}
.Selector select:focus,
.Selector input[type="number"]:focus {
    border-color: #512da8; /* morado */
    box-shadow: 0 0 4px rgba(81, 45, 168, 0.4);
    outline: none;
}

/* Vista previa del color */
#selected-color-preview {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 6px;
    font-size: 0.9rem;
    color: #555;
}
#color-preview {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    border: 1px solid #ccc;
}

/* Nota de máximo stock */
#maxStock {
    font-size: 0.85rem;
    color: #888;
    margin-top: 5px;
}

/* Botón de agregar al carrito */
.Boton-Agregar-Carrito {
    background: #283593;
    color: #fff;
    padding: 12px 18px;
    border-radius: 6px;
    border: none;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
}
.Boton-Agregar-Carrito:hover {
    background: #1a237e;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
.Boton-Agregar-Carrito:disabled {
    background: #ccc;
    cursor: not-allowed;
    box-shadow: none;
}

    </style>
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

    <div class="Detalle-Producto-Contenedor">
        <div class="Detalle-Producto">
            <div class="Imagen-Producto">
                <img src="{{ asset($articulo->Foto) }}" alt="{{ $articulo->N_Articulo }}">
            </div>
            
            <div class="Informacion-Producto">
                <h1>{{ $articulo->N_Articulo }}</h1>
                <div class="Categoria-Genero">
                    <span>{{ $articulo->categoria->N_Categoria }}</span>
                    <span>{{ $articulo->genero->N_Genero }}</span>
                </div>
                <p class="SubCategoria">{{ $articulo->subcategoria->SubCategoria }}</p>
                
                <p class="Precio">${{ number_format($articulo->precio->Valor, 0, ',', '.') }}</p>
                
                @php
                    $variantesConStock = $productos->where('Cantidad', '>', 0);
                    $totalVariantes = $variantesConStock->count();
                @endphp
                <!-- Stock general -->
                <p class="Stock {{ $totalVariantes > 0 ? 'Disponible' : 'Agotado' }}" id="stockGeneral">
                    {{ $totalVariantes > 0 ? 'En stock (' . $totalVariantes . ' variantes disponibles)' : 'Agotado' }}
                </p>

                <!-- Stock específico -->
                <p class="Stock Disponible" id="stockEspecifico" style="display: none;">
                    <span id="textoStock"></span>
                </p>
                
                <form action="{{ route('carrito.agregar') }}" method="POST" class="Formulario-Compra">
                    @csrf
                    <input type="hidden" name="id_articulo" value="{{ $articulo->ID_Articulo }}">
                    
                    <!-- Selector de Color -->
                    <div class="Selector">
                        <label for="color">Color:</label>
                        <select name="color" id="color" required>
                            <option value="">Seleccione un color</option>
                            @foreach($colores as $color)
                                <option value="{{ $color['id'] }}" data-tallas="{{ json_encode($color['tallas']) }}" data-hex="{{ $color['hex'] }}">
                                    {{ $color['nombre'] }}
                                </option>
                            @endforeach
                        </select>
                        <div id="selected-color-preview" style="margin-top: 5px; display: none;">
                            <span class="color-circle" id="color-preview"></span>
                            <span id="color-name"></span>
                        </div>
                    </div>
                    
                    <!-- Selector de Talla -->
                    <div class="Selector">
                        <label for="talla">Talla:</label>
                        <select name="talla" id="talla" required>
                            <option value="">Seleccione una talla</option>
                            @foreach($tallas as $talla)
                                <option value="{{ $talla['id'] }}" data-colores="{{ json_encode($talla['colores']) }}">
                                    {{ $talla['nombre'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Cantidad -->
                    <div class="Selector">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad" min="1" 
                                value="1" required>
                        <small id="maxStock" style="display: none;">Máximo: <span id="maxStockValue"></span></small>
                    </div>
                    
                    <!-- Botón de agregar al carrito -->
                    <button type="submit" class="Boton-Agregar-Carrito" id="btnAgregarCarrito" disabled>
                        Agregar al carrito
                    </button>
                </form>

                <!-- Variantes disponibles -->
                <div class="variantes-disponibles" style="margin-top: 20px;">
                    <h3>Variantes disponibles:</h3>
                    <div id="variantes-container">
                        <!-- Las variantes se cargarán aquí dinámicamente -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="Pie-Pagina">
            <div class="Derechos">
                <div class="Texto-Derechos">
                    <p>&copy; 2025 TuLook. Todos los derechos reservados a los creadores.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
    $(document).ready(function() {
        var $colorSelect = $('#color');
        var $tallaSelect = $('#talla');
        var $cantidadInput = $('#cantidad');
        var $stockGeneral = $('#stockGeneral');
        var $stockEspecifico = $('#stockEspecifico');
        var $maxStock = $('#maxStock');
        var $btnAgregar = $('#btnAgregarCarrito');
        var $colorPreview = $('#color-preview');
        var $colorName = $('#color-name');
        var $selectedColorPreview = $('#selected-color-preview');
        
        var stockPorCombinacion = <?php echo json_encode($stockPorCombinacion); ?>;
        var variantes = <?php echo json_encode($variantesParaJS); ?>;

        // Función para debug - agrega esto temporalmente
        console.log('Variantes cargadas:', variantes);
        console.log('Total de variantes:', variantes.length);

        function actualizarStockDisponible() {
            var colorId = $colorSelect.val();
            var tallaId = $tallaSelect.val();
            
            if (colorId && tallaId) {
                var key = colorId + '_' + tallaId;
                var stock = stockPorCombinacion[key] || 0;
                
                $stockGeneral.hide();
                $stockEspecifico.show();
                
                if (stock > 0) {
                    $stockEspecifico.removeClass('Agotado').addClass('Disponible');
                    $('#textoStock').text('Stock disponible: ' + stock + ' unidades');
                    
                    $cantidadInput.attr('max', stock);
                    $maxStock.show();
                    $('#maxStockValue').text(stock);
                    
                    $btnAgregar.prop('disabled', false);
                    
                    if (parseInt($cantidadInput.val()) > stock) {
                        $cantidadInput.val(stock);
                    }
                } else {
                    $stockEspecifico.removeClass('Disponible').addClass('Agotado');
                    $('#textoStock').text('Agotado');
                    $cantidadInput.attr('max', 0);
                    $maxStock.hide();
                    $btnAgregar.prop('disabled', true);
                }
            } else {
                $stockGeneral.show();
                $stockEspecifico.hide();
                $maxStock.hide();
                $btnAgregar.prop('disabled', true);
            }
        }

        // Función para filtrar y mostrar las variantes disponibles
        function actualizarVariantesDisponibles() {
            var colorId = $colorSelect.val();
            var tallaId = $tallaSelect.val();
            var $variantesContainer = $('#variantes-container');
            
            // Limpiar contenedor
            $variantesContainer.empty();
            
            // Debug
            console.log('Filtrando - Color:', colorId, 'Talla:', tallaId);
            
            // Filtrar variantes según selección
            var variantesFiltradas = variantes.filter(function(variante) {
                var coincideColor = !colorId || variante.color_id == colorId;
                var coincideTalla = !tallaId || variante.talla_id == tallaId;
                return coincideColor && coincideTalla;
            });
            
            // Debug
            console.log('Variantes filtradas:', variantesFiltradas.length);
            
            // Mostrar variantes filtradas
            if (variantesFiltradas.length > 0) {
                variantesFiltradas.forEach(function(variante) {
                    var varianteHtml = `
                        <div class="variante-item" style="border: 1px solid #ccc; padding: 10px; margin: 5px;">
                            <p><strong>Color:</strong> 
                                <span class="variante-color" style="background-color: ${variante.color_hex || '#ccc'}"></span>
                                ${variante.color_nombre}
                            </p>
                            <p><strong>Talla:</strong> ${variante.talla_nombre}</p>
                            <p><strong>Stock:</strong> ${variante.cantidad} unidades</p>
                        </div>
                    `;
                    $variantesContainer.append(varianteHtml);
                });
            } else {
                $variantesContainer.html('<p>No hay variantes disponibles con los filtros seleccionados.</p>');
            }
        }

        $colorSelect.change(function() {
            var selectedOption = $(this).find('option:selected');
            var colorHex = selectedOption.data('hex');
            var colorName = selectedOption.text();
            
            if (colorHex && colorName !== 'Seleccione un color') {
                $colorPreview.css('background-color', colorHex);
                $colorName.text(colorName);
                $selectedColorPreview.show();
            } else {
                $selectedColorPreview.hide();
            }
            
            var availableTallas = selectedOption.data('tallas') || [];
            $tallaSelect.find('option').prop('disabled', false);
            
            if (selectedOption.val()) {
                $tallaSelect.find('option').each(function() {
                    var tallaId = $(this).val();
                    if (tallaId && !availableTallas.includes(parseInt(tallaId))) {
                        $(this).prop('disabled', true);
                    }
                });
                if ($tallaSelect.val() && !availableTallas.includes(parseInt($tallaSelect.val()))) {
                    $tallaSelect.val('');
                }
            }
            
            actualizarStockDisponible();
            actualizarVariantesDisponibles(); // Esta línea debe estar aquí
        });

        $tallaSelect.change(function() {
            var selectedTalla = $(this).val();
            var availableColores = $(this).find('option:selected').data('colores') || [];
            $colorSelect.find('option').prop('disabled', false);
            
            if (selectedTalla) {
                $colorSelect.find('option').each(function() {
                    var colorId = $(this).val();
                    if (colorId && !availableColores.includes(parseInt(colorId))) {
                        $(this).prop('disabled', true);
                    }
                });
                if ($colorSelect.val() && !availableColores.includes(parseInt($colorSelect.val()))) {
                    $colorSelect.val('');
                }
            }
            
            actualizarStockDisponible();
            actualizarVariantesDisponibles(); // Esta línea debe estar aquí
        });

        $cantidadInput.change(function() {
            var max = parseInt($(this).attr('max'));
            var valor = parseInt($(this).val());
            
            if (valor > max) {
                $(this).val(max);
            } else if (valor < 1) {
                $(this).val(1);
            }
        });

        // Inicializar variantes al cargar la página
        actualizarVariantesDisponibles();
    });
    </script>
</body>
</html>
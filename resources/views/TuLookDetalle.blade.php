<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto - TuLook</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                <option value="{{ $color['id'] }}" data-tallas="{{ json_encode($color['tallas'] ?? []) }}" data-hex="{{ $color['hex'] }}">
                                    {{ $color['nombre'] }}
                                </option>
                            @endforeach
                        </select>
                        <div id="selected-color-preview" style="margin-top: 5px; display: none; display: flex; align-items: center; gap: 8px;">
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
                                <option value="{{ $talla['id'] }}" data-colores="{{ json_encode($talla['colores'] ?? []) }}">
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
        // Almacena las variables de jQuery en caché para un acceso más rápido
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
        var $variantesContainer = $('#variantes-container');

        // Solución robusta: pasar los datos de PHP a JavaScript de forma segura
        // Se utiliza json_encode para evitar el error de la directiva Js::from()
        var stockPorCombinacion = <?php echo json_encode($stockPorCombinacion ?? []); ?>;
        var variantes = <?php echo json_encode($variantesParaJS ?? []); ?>;

        var tallasPorColor = {};
        var coloresPorTalla = {};

        // Función para inicializar los datos de combinaciones
        function inicializarDatos() {
            $colorSelect.find('option[value!=""]').each(function() {
                var colorId = $(this).val();
                tallasPorColor[colorId] = $(this).data('tallas');
            });
            $tallaSelect.find('option[value!=""]').each(function() {
                var tallaId = $(this).val();
                coloresPorTalla[tallaId] = $(this).data('colores');
            });
        }

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
                    $cantidadInput.val(0); // Pone la cantidad a 0 si no hay stock
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

        function actualizarVariantesDisponibles() {
            var colorId = $colorSelect.val();
            var tallaId = $tallaSelect.val();
            
            $variantesContainer.empty();
            
            var variantesFiltradas = variantes.filter(function(variante) {
                var coincideColor = !colorId || variante.color_id == colorId;
                var coincideTalla = !tallaId || variante.talla_id == tallaId;
                return coincideColor && coincideTalla;
            });
            
            if (variantesFiltradas.length > 0) {
                variantesFiltradas.forEach(function(variante) {
                    var varianteHtml = `
                        <div class="variante-item" style="border: 1px solid #ccc; padding: 10px; margin: 5px; border-radius: 8px;">
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

        // Manejadores de eventos para los selectores
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
            
            var selectedColorId = $(this).val();
            var selectedTallaId = $tallaSelect.val();

            // Sincronizar tallas
            $tallaSelect.find('option[value!=""]').each(function() {
                var tallaId = $(this).val();
                var disponible = coloresPorTalla[tallaId] && coloresPorTalla[tallaId].includes(parseInt(selectedColorId));
                $(this).prop('disabled', !disponible);
            });
            
            // Si la talla seleccionada ya no es válida, la deselecciona
            if (selectedTallaId && (!coloresPorTalla[selectedTallaId] || !coloresPorTalla[selectedTallaId].includes(parseInt(selectedColorId)))) {
                $tallaSelect.val('');
            }
            
            actualizarStockDisponible();
            actualizarVariantesDisponibles();
        });

        $tallaSelect.change(function() {
            var selectedTallaId = $(this).val();
            var selectedColorId = $colorSelect.val();

            // Sincronizar colores
            $colorSelect.find('option[value!=""]').each(function() {
                var colorId = $(this).val();
                var disponible = tallasPorColor[colorId] && tallasPorColor[colorId].includes(parseInt(selectedTallaId));
                $(this).prop('disabled', !disponible);
            });
            
            // Si el color seleccionado ya no es válido, lo deselecciona
            if (selectedColorId && (!tallasPorColor[selectedColorId] || !tallasPorColor[selectedColorId].includes(parseInt(selectedTallaId)))) {
                $colorSelect.val('');
                $selectedColorPreview.hide();
            }

            actualizarStockDisponible();
            actualizarVariantesDisponibles();
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

        // Inicializar al cargar la página
        inicializarDatos();
        actualizarVariantesDisponibles();
        actualizarStockDisponible();
    });
    </script>
</body>
</html>
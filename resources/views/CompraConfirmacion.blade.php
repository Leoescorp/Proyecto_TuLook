<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Confirmada - TuLook</title>
    <link href="{{ asset('css/TuLook.css') }}" rel="stylesheet">
    <style>
        .confirmacion-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            text-align: center;
            background: #f9f9f9;
            border-radius: 10px;
        }
        
        .confirmacion-icon {
            font-size: 60px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        
        .confirmacion-titulo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .confirmacion-codigo {
            background: #fff;
            padding: 15px;
            border-radius: 5px;
            font-size: 18px;
            margin: 20px 0;
            display: inline-block;
        }
        
        .info-cliente, .resumen-compra {
            text-align: left;
            margin-top: 30px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        
        .info-cliente p, .resumen-item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .resumen-item {
            display: flex;
            justify-content: space-between;
        }
        
        .acciones {
            margin-top: 30px;
        }
        
        .btn-seguimiento, .btn-inicio {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            background: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <nav class="Barra-Navegacion">
        <div class="Navegacion">
            <img src="{{ asset('ImgTuLook/TuLook.jpg') }}" alt="TuLook">
            <a class="Titulo-Principal" href="{{ route('TuLook') }}">TuLook</a>
            <a href="{{ route('carrito.ver') }}" class="carrito-link">🛒 Carrito</a>
        </div>
    </nav>

    <div class="confirmacion-container">
        <div class="confirmacion-icon">✓</div>
        <h1 class="confirmacion-titulo">¡Compra realizada con éxito!</h1>
        <p>Tu pedido ha sido procesado correctamente.</p>
        
        <div class="confirmacion-codigo">
            Código de seguimiento: <strong>{{ $factura->Codigo_Acceso }}</strong>
        </div>
        
        <!-- INFORMACIÓN DEL CLIENTE - AQUÍ VA LA SECCIÓN NUEVA -->
        <div class="info-cliente">
            <h2>Información del cliente</h2>
            <p><strong>Nombre:</strong> {{ $factura->Cliente_Nombre }}</p>
            <p><strong>Email:</strong> {{ $factura->Cliente_Email }}</p>
            <p><strong>Teléfono:</strong> {{ $factura->Cliente_Telefono }}</p>
            <p><strong>Dirección de envío:</strong> {{ $factura->Direccion_Envio }}</p>
        </div>
        
        <div class="resumen-compra">
            <h2>Resumen de tu compra</h2>
            @foreach($productos as $producto)
            <div class="resumen-item">
                <div>
                    <strong>{{ $producto->producto->articulo->N_Articulo }}</strong>
                    <p>Cantidad: {{ $producto->Cantidad }}</p>
                </div>
                <div>${{ number_format($producto->producto->articulo->precio->Valor * $producto->Cantidad, 0, ',', '.') }}</div>
            </div>
            @endforeach
            
            <div class="resumen-item" style="border-top: 2px solid #000; font-weight: bold;">
                <div>Total:</div>
                <div>${{ number_format($factura->Monto_Total, 0, ',', '.') }}</div>
            </div>
        </div>
        
        <div class="acciones">
            <a href="{{ route('compra.seguimiento', $factura->Codigo_Acceso) }}" class="btn-seguimiento">Ver seguimiento</a>
            <a href="{{ route('TuLook') }}" class="btn-inicio">Seguir comprando</a>
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
</body>
</html>
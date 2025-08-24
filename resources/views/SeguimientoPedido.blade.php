<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Pedido - TuLook</title>
    <link href="{{ asset('css/TuLook.css') }}" rel="stylesheet">
    <style>
        .seguimiento-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
        }
        
        .estado-pedido {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            position: relative;
        }
        
        .estado-paso {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .estado-paso .icono {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }
        
        .estado-paso.activo .icono {
            background: #4CAF50;
            color: white;
        }
        
        .estado-paso.completado .icono {
            background: #4CAF50;
            color: white;
        }
        
        .linea-estado {
            position: absolute;
            top: 25px;
            left: 0;
            right: 0;
            height: 2px;
            background: #ddd;
            z-index: 1;
        }
        
        .info-pedido {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .productos-pedido {
            margin-top: 30px;
        }
        
        .producto-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .info-cliente {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
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

    <div class="seguimiento-container">
        <h1>Seguimiento de tu Pedido</h1>
        <p>Código de seguimiento: <strong>{{ $factura->Codigo_Acceso }}</strong></p>
        
        <div class="estado-pedido">
            <div class="linea-estado"></div>
            
            <div class="estado-paso {{ $factura->Estado == 'Pendiente' ? 'activo' : 'completado' }}">
                <div class="icono">1</div>
                <div>Confirmado</div>
            </div>
            
            <div class="estado-paso {{ $factura->Estado == 'En preparación' ? 'activo' : ($factura->Estado == 'Enviado' || $factura->Estado == 'Entregado' ? 'completado' : '') }}">
                <div class="icono">2</div>
                <div>En preparación</div>
            </div>
            
            <div class="estado-paso {{ $factura->Estado == 'Enviado' ? 'activo' : ($factura->Estado == 'Entregado' ? 'completado' : '') }}">
                <div class="icono">3</div>
                <div>Enviado</div>
            </div>
            
            <div class="estado-paso {{ $factura->Estado == 'Entregado' ? 'activo' : '' }}">
                <div class="icono">4</div>
                <div>Entregado</div>
            </div>
        </div>
        
        <!-- INFORMACIÓN DEL CLIENTE EN SEGUIMIENTO -->
        <div class="info-cliente">
            <h2>Información del cliente</h2>
            <div class="info-item">
                <span>Nombre:</span>
                <span>{{ $factura->Cliente_Nombre }}</span>
            </div>
            <div class="info-item">
                <span>Email:</span>
                <span>{{ $factura->Cliente_Email }}</span>
            </div>
            <div class="info-item">
                <span>Teléfono:</span>
                <span>{{ $factura->Cliente_Telefono }}</span>
            </div>
            <div class="info-item">
                <span>Dirección de envío:</span>
                <span>{{ $factura->Direccion_Envio }}</span>
            </div>
        </div>
        
        <div class="info-pedido">
            <h2>Información del pedido</h2>
            <div class="info-item">
                <span>Fecha de compra:</span>
                <span>{{ $factura->Fecha_Factura->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-item">
                <span>Estado actual:</span>
                <span><strong>{{ $factura->Estado }}</strong></span>
            </div>
            <div class="info-item">
                <span>Método de pago:</span>
                <span>{{ $factura->metodoPago->T_Pago }}</span>
            </div>
            <div class="info-item">
                <span>Total:</span>
                <span>${{ number_format($factura->Monto_Total, 0, ',', '.') }}</span>
            </div>
        </div>
        
        <div class="productos-pedido">
            <h2>Productos en tu pedido</h2>
            @foreach($factura->productosFactura as $producto)
            <div class="producto-item">
                <div>
                    <strong>{{ $producto->producto->articulo->N_Articulo }}</strong>
                    <p>Cantidad: {{ $producto->Cantidad }}</p>
                </div>
                <div>${{ number_format($producto->producto->articulo->precio->Valor * $producto->Cantidad, 0, ',', '.') }}</div>
            </div>
            @endforeach
            
            <div class="producto-item" style="border-top: 2px solid #000; font-weight: bold;">
                <div>Total:</div>
                <div>${{ number_format($factura->Monto_Total, 0, ',', '.') }}</div>
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
</body>
</html>
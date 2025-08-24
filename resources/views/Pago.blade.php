<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago - TuLook</title>
    <link href="{{ asset('css/TuLook.css') }}" rel="stylesheet">
    <style>
        .pago-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            text-align: center;
        }
        
        .pago-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        
        .resumen-pedido {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            text-align: left;
        }
        
        .resumen-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .total-resumen {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
        }
        
        .btn-confirmar {
            padding: 15px 30px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
            margin: 20px 0;
        }
        
        .btn-cancelar {
            padding: 15px 30px;
            background: #666;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
            margin-left: 15px;
            text-decoration: none;
            display: inline-block;
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

    <div class="pago-container">
        <h1 class="pago-title">Confirmar Compra</h1>
        
        @if(session('error'))
        <div style="background: #ffebee; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #f44336;">
            <strong>Error:</strong> {{ session('error') }}
        </div>
        @endif
        
        <div class="resumen-pedido">
            <h2>Resumen de tu pedido</h2>
            @foreach($carrito as $item)
            <div class="resumen-item">
                <div>
                    <strong>{{ $item['nombre'] }}</strong>
                    <p>Color: {{ $item['color'] }} | Talla: {{ $item['talla'] }}</p>
                    <p>Cantidad: {{ $item['cantidad'] }}</p>
                </div>
                <div>${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}</div>
            </div>
            @endforeach
            
            <div class="total-resumen">
                <div class="resumen-item">
                    <span>Total:</span>
                    <span>${{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <form action="{{ route('compra.procesar') }}" method="POST">
            @csrf
            <button type="submit" class="btn-confirmar">Confirmar Compra</button>
            <a href="{{ route('carrito.ver') }}" class="btn-cancelar">Cancelar</a>
        </form>
        
        <p>Al confirmar, la compra se procesará automáticamente con ID de usuario 1.</p>
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
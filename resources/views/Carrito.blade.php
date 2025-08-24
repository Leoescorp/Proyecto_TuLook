<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - TuLook</title>
    <link href="{{ asset('css/TuLook.css') }}" rel="stylesheet">
    <style>
        .carrito-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        
        .carrito-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .carrito-title {
            font-size: 24px;
            font-weight: bold;
        }
        
        .carrito-items {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .carrito-item {
            display: grid;
            grid-template-columns: 100px 1fr 150px 100px 100px 50px;
            gap: 15px;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .item-img img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        
        .item-info h4 {
            margin: 0;
            font-size: 16px;
        }
        
        .item-attributes {
            font-size: 14px;
            color: #666;
        }
        
        .item-price {
            font-weight: bold;
        }
        
        .item-quantity {
            font-weight: bold;
            text-align: center;
        }
        
        .item-subtotal {
            font-weight: bold;
            text-align: right;
        }
        
        .item-remove {
            color: #ff0000;
            cursor: pointer;
            text-align: center;
        }
        
        .carrito-summary {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }
        
        .summary-box {
            width: 300px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .summary-total {
            font-size: 18px;
            font-weight: bold;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .checkout-btn {
            width: 100%;
            padding: 10px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 15px;
        }
        
        .empty-cart {
            text-align: center;
            padding: 50px 0;
        }
        
        .empty-cart p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        
        .continue-shopping {
            display: inline-block;
            padding: 10px 20px;
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

    <div class="carrito-container">
        <div class="carrito-header">
            <h1 class="carrito-title">Tu Carrito de Compras</h1>
            <a href="{{ route('TuLook') }}" class="continue-shopping">Continuar Comprando</a>
        </div>
        
        @if(count($carrito) > 0)
            <div class="carrito-items">
                @foreach($carrito as $key => $item)
                <div class="carrito-item">
                    <div class="item-img">
                        <img src="{{ asset($item['imagen']) }}" alt="{{ $item['nombre'] }}">
                    </div>
                    <div class="item-info">
                        <h4>{{ $item['nombre'] }}</h4>
                        <div class="item-attributes">
                            <p>Color: {{ $item['color'] }}</p>
                            <p>Talla: {{ $item['talla'] }}</p>
                        </div>
                    </div>
                    <div class="item-price">
                        ${{ number_format($item['precio'], 0, ',', '.') }}
                    </div>
                    <div class="item-quantity">
                        {{ $item['cantidad'] }} <!-- SOLO MUESTRA LA CANTIDAD -->
                    </div>
                    <div class="item-subtotal">
                        ${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}
                    </div>
                    <div class="item-remove">
                        <form action="{{ route('carrito.eliminar', $key) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; cursor:pointer; color:red;">✕</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="carrito-summary">
                <div class="summary-box">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Envío:</span>
                        <span>Calculado al finalizar</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span>Total:</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('carrito.pago') }}" class="checkout-btn" style="display: block; text-align: center; text-decoration: none; color: white;">Proceder al Pago</a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <p>Tu carrito está vacío</p>
                <a href="{{ route('TuLook') }}" class="continue-shopping">Continuar Comprando</a>
            </div>
        @endif
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
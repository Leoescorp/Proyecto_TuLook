<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\FacturaProducto;
use App\Models\MetodoPago;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CompraController extends Controller
{
    // Mostrar formulario de pago
    public function mostrarFormularioPago()
    {
        $carrito = Session::get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío');
        }
        
        $total = $this->calcularTotalCarrito($carrito);
        
        return view('Pago', [
            'carrito' => $carrito,
            'total' => $total
        ]);
    }

    // En el método procesarCompra:
    public function procesarCompra(Request $request)
    {
        $carrito = Session::get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío');
        }

        // Verificar stock
        foreach ($carrito as $key => $item) {
            $producto = Producto::find($item['producto_id']);
            
            if (!$producto || $producto->Cantidad < $item['cantidad']) {
                return redirect()->route('carrito.ver')->with('error', 
                    'El producto "' . $item['nombre'] . '" ya no tiene stock suficiente');
            }
        }

        // Iniciar transacción
        DB::beginTransaction();

        try {
            // Crear la factura
            $factura = new Factura();
            $factura->Fecha_Factura = now();
            $factura->Monto_Total = $this->calcularTotalCarrito($carrito);
            $factura->Direccion_Envio = "Compra online - " . now()->format('d/m/Y H:i');
            $factura->Estado = 'Confirmado';
            $factura->ID_Metodo_Pago = 1; // Valor por defecto (Tarjeta)
            $factura->ID_Usuario = 1; // Usuario fijo
            $factura->Codigo_Acceso = strtoupper(Str::random(8));
            
            $factura->save();

            // Registrar productos de la factura y actualizar stock
            foreach ($carrito as $item) {
                $facturaProducto = new FacturaProducto();
                $facturaProducto->ID_Factura = $factura->ID_Factura;
                $facturaProducto->ID_Producto = $item['producto_id'];
                $facturaProducto->Cantidad = $item['cantidad'];
                $facturaProducto->save();

                // Actualizar stock
                $producto = Producto::find($item['producto_id']);
                $producto->Cantidad -= $item['cantidad'];
                $producto->save();
            }

            // Limpiar el carrito después de la compra exitosa
            Session::forget('carrito');

            DB::commit();

            // Redirigir a página de confirmación
            return redirect()->route('compra.confirmacion', ['codigo' => $factura->Codigo_Acceso])
                            ->with('success', 'Compra realizada con éxito');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar compra: ' . $e->getMessage());
            
            return redirect()->route('carrito.ver')->with('error', 
                'Ocurrió un error al procesar tu compra. Por favor, intenta nuevamente.');
        }
    }

    // Página de confirmación de compra
    public function confirmacionCompra($codigo)
    {
        Log::info('=== CONFIRMACIÓN DE COMPRA ===');
        Log::info('Código: ' . $codigo);
        
        try {
            $factura = Factura::where('Codigo_Acceso', $codigo)
                             ->with(['productosFactura.producto.articulo', 'metodoPago'])
                             ->firstOrFail();
            
            Log::info('Factura encontrada: ' . $factura->ID_Factura);
            
            return view('CompraConfirmacion', [
                'factura' => $factura,
                'productos' => $factura->productosFactura
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al cargar confirmación: ' . $e->getMessage());
            return redirect()->route('carrito.ver')->with('error', 'Factura no encontrada: ' . $codigo);
        }
    }

    // Seguimiento de pedido
    public function seguimientoPedido($codigo)
    {
        try {
            $factura = Factura::where('Codigo_Acceso', $codigo)
                                ->with(['productosFactura.producto.articulo', 'metodoPago'])
                                ->firstOrFail();
            
            return view('SeguimientoPedido', [
                'factura' => $factura
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al cargar seguimiento: ' . $e->getMessage());
            return redirect()->route('TuLook')->with('error', 'Pedido no encontrado');
        }
    }

    // Calcular total del carrito
    private function calcularTotalCarrito($carrito)
    {
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return $total;
    }
}
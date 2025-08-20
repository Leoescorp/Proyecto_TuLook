<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Producto;
use App\Models\Color;
use App\Models\Talla;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class Carrito_Control extends Controller
{
    // Mostrar el carrito
    public function verCarrito()
    {
        $carrito = Session::get('carrito', []);
        $total = $this->calcularTotal($carrito);
        
        return view('Carrito', [
            'carrito' => $carrito,
            'total' => $total
        ]);
    }

    // Agregar producto al carrito
    public function agregarAlCarrito(Request $request)
    {
        $request->validate([
            'id_articulo' => 'required|exists:articulo,ID_Articulo',
            'color' => 'required|exists:color,ID_Color',
            'talla' => 'required|exists:talla,ID_Talla',
            'cantidad' => 'required|integer|min:1'
        ]);

        $articulo = Articulo::find($request->id_articulo);
        $color = Color::find($request->color);
        $talla = Talla::find($request->talla);

        // Verificar producto específico
        $producto = Producto::where('ID_Articulo', $request->id_articulo)
                        ->where('ID_Color', $request->color)
                        ->where('ID_Talla', $request->talla)
                        ->first();

        if (!$producto) {
            return back()->with('error', 'La combinación seleccionada no está disponible.');
        }

        // Verificar stock
        if ($producto->Cantidad < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $carrito = Session::get('carrito', []);

        // Buscar item idéntico en el carrito
        $itemExistente = null;
        foreach ($carrito as $key => $item) {
            if ($item['articulo_id'] == $request->id_articulo &&
                $item['color_id'] == $request->color &&
                $item['talla_id'] == $request->talla) {
                $itemExistente = $key;
                break;
            }
        }

        if ($itemExistente !== null) {
            // Actualizar cantidad si ya existe
            $carrito[$itemExistente]['cantidad'] += $request->cantidad;
        } else {
            // Agregar nuevo item con clave basada en producto_id
            $carrito['prod_'.$producto->ID_Producto] = [
                'producto_id' => $producto->ID_Producto,
                'articulo_id' => $articulo->ID_Articulo,
                'nombre' => $articulo->N_Articulo,
                'color_id' => $request->color,
                'color' => $color->N_Color,
                'talla_id' => $request->talla,
                'talla' => $talla->N_Talla,
                'precio' => $articulo->precio->Valor,
                'cantidad' => $request->cantidad,
                'imagen' => $articulo->Foto,
                'unique_key' => 'prod_'.$producto->ID_Producto
            ];
        }

        Session::put('carrito', $carrito);
        return redirect()->route('carrito.ver')->with('success', 'Producto agregado al carrito');
    }

    // Eliminar producto del carrito
    public function eliminarDelCarrito($key)
    {
        $carrito = Session::get('carrito', []);

        if (strpos($key, 'prod_') === 0 && array_key_exists($key, $carrito)) {
            unset($carrito[$key]);
            Session::put('carrito', $carrito);
            return back()->with('success', 'Producto eliminado del carrito');
        }

        return back()->with('error', 'Producto no encontrado en el carrito');
    }

    // Calcular total del carrito (MÉTODO QUE FALTABA)
    private function calcularTotal($carrito)
    {
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return $total;
    }
}
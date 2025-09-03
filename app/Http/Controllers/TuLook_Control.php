<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Genero;
use App\Models\Subcategoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TuLook_Control extends Controller
{
    /**
     * Muestra la tienda (vista de invitado o usuario logueado).
     *
     * @param Request $parametros
     * @return \Illuminate\View\View
     */
    public function index(Request $parametros)
    {
        // Obtener parámetros de filtrado
        $categoria = $parametros->input('categoria');
        $subcategoria = $parametros->input('subcategoria');
        $genero = $parametros->input('genero');
        $buscar = $parametros->input('buscar');

        // Consulta base con relaciones
        $query = Articulo::with(['categoria', 'subcategoria', 'genero', 'precio', 'productos.color', 'productos.talla'])
                        ->where('Activo', 1);

        // Aplicar filtros
        if ($categoria) {
            $query->whereHas('categoria', function ($Buscar) use ($categoria) {
                $Buscar->where('N_Categoria', $categoria);
            });
        }

        if ($subcategoria) {
            $query->whereHas('subcategoria', function ($Buscar) use ($subcategoria) {
                $Buscar->where('SubCategoria', $subcategoria);
            });
        }

        if ($genero) {
            $query->whereHas('genero', function ($Buscar) use ($genero) {
                $Buscar->where('N_Genero', $genero);
            });
        }

        if ($buscar) {
            $query->where('N_Articulo', 'like', '%' . $buscar . '%');
        }

        // Obtener artículos filtrados
        $articulos = $query->get();

        // Obtener datos para filtros
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $generos = Genero::all();

        // 🔹 Detecta si está logueado o no y retorna la vista correspondiente
        if (Auth::check()) {
            return view('TuLookUser', compact('articulos', 'categorias', 'subcategorias', 'generos'));
        } else {
            return view('TuLook', compact('articulos', 'categorias', 'subcategorias', 'generos'));
        }
    }

    /**
     * Muestra los detalles de un artículo específico.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $articulo = Articulo::with(['categoria', 'subcategoria', 'genero', 'precio'])
                            ->where('ID_Articulo', $id)
                            ->where('Activo', 1)
                            ->firstOrFail();

        // Obtener productos específicos para este artículo
        $productos = Producto::with(['color', 'talla'])
                            ->where('ID_Articulo', $id)
                            ->get();

        // Preparamos datos para selectores dinámicos
        $colores = [];
        $tallas = [];
        $stockPorCombinacion = [];
        $variantesParaJS = [];

        foreach ($productos as $producto) {
            if ($producto->color) {
                $colores[$producto->color->ID_Color] = [
                    'id' => $producto->color->ID_Color,
                    'nombre' => $producto->color->N_Color,
                    'hex' => $producto->color->CodigoHex,
                    'tallas' => []
                ];
            }

            if ($producto->talla) {
                $tallas[$producto->talla->ID_Talla] = [
                    'id' => $producto->talla->ID_Talla,
                    'nombre' => $producto->talla->N_Talla,
                    'colores' => []
                ];
            }

            if ($producto->color && $producto->talla) {
                $key = $producto->color->ID_Color . '_' . $producto->talla->ID_Talla;
                $stockPorCombinacion[$key] = $producto->Cantidad;

                $variantesParaJS[] = [
                    'color_id' => $producto->color->ID_Color,
                    'color_nombre' => $producto->color->N_Color,
                    'color_hex' => $producto->color->CodigoHex,
                    'talla_id' => $producto->talla->ID_Talla,
                    'talla_nombre' => $producto->talla->N_Talla,
                    'cantidad' => $producto->Cantidad
                ];
            }
        }

        foreach ($productos as $producto) {
            if ($producto->color && $producto->talla) {
                $colores[$producto->color->ID_Color]['tallas'][] = $producto->talla->ID_Talla;
                $tallas[$producto->talla->ID_Talla]['colores'][] = $producto->color->ID_Color;
            }
        }

        return view('TuLookDetalle', [
            'articulo' => $articulo,
            'productos' => $productos,
            'colores' => array_values($colores),
            'tallas' => array_values($tallas),
            'stockPorCombinacion' => $stockPorCombinacion,
            'variantesParaJS' => $variantesParaJS
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Genero;
use App\Models\Subcategoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class TuLook_Control extends Controller
{
    public function index(Request $parametros)
    {       
        // Obtener parámetros de filtrado
        $categoria = $parametros->input('categoria');
        $subcategoria = $parametros->input('subcategoria');
        $genero = $parametros->input('genero');

        // Consulta base con relaciones
        $query = Articulo::with(['categoria', 'subcategoria', 'genero', 'precio', 'productos.color', 'productos.talla'])
                    ->where('Activo', 1);
        
        //buscar nombre//
        $buscar = $parametros->input('buscar');
        
        // Aplicar filtros
        // Filtro por categoría
        if ($categoria) {
            $query->whereHas('categoria', function($Buscar) use ($categoria) {
                $Buscar->where('N_Categoria', $categoria);
            });
        }

        // Filtro por subcategoría
        if ($subcategoria) {
            $query->whereHas('subcategoria', function($Buscar) use ($subcategoria) {
                $Buscar->where('SubCategoria', $subcategoria);
            });
        }

        // Filtro por género
        if ($genero) {
            $query->whereHas('genero', function($Buscar) use ($genero) {
                $Buscar->where('N_Genero', $genero);
            });
        }

        // Filtro por nombre de artículo
        if ($buscar) {
            $query->where('N_Articulo', 'like', '%' . $buscar . '%');
        }
        
        $articulos = $query->get();
        
        // Obtener datos para filtros
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $generos = Genero::all();

        return view('TuLook', compact('articulos', 'categorias', 'subcategorias', 'generos'));
    }
    
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

        // Preparamos datos para los selectores dinámicos
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
            
            // Almacenar stock por combinación
            if ($producto->color && $producto->talla) {
                $key = $producto->color->ID_Color . '_' . $producto->talla->ID_Talla;
                $stockPorCombinacion[$key] = $producto->Cantidad;
            }
            
            // Preparar datos para JavaScript
            $variantesParaJS[] = [
                'color_id' => $producto->color->ID_Color,
                'color_nombre' => $producto->color->N_Color,
                'color_hex' => $producto->color->CodigoHex,
                'talla_id' => $producto->talla->ID_Talla,
                'talla_nombre' => $producto->talla->N_Talla,
                'cantidad' => $producto->Cantidad
            ];
        }
        
        // Llenamos las relaciones
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
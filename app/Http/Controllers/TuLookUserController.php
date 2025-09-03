<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Genero;

class TuLookUserController extends Controller
{
    public function index(Request $request)
    {
        $usuario = Auth::user();

        // Obtener parámetros de filtrado
        $categoria = $request->input('categoria');
        $subcategoria = $request->input('subcategoria');
        $genero = $request->input('genero');
        $buscar = $request->input('buscar');

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

        $articulos = $query->get();
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $generos = Genero::all();

        return view('TulookUser', compact('usuario', 'articulos', 'categorias', 'subcategorias', 'generos'));
    }
}
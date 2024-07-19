<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Config;
use PDF;
use DB;

class InventarioController extends Controller
{
    public function index(Request $request)
	{
        // dd($request->all());
        if ($request) {
            $articulos = Articulo::query();
            if ($request->has('nombre') && $request->input('nombre') !== null) {
                $articulos->where(function ($query) use ($request) {
                    $query->where('nombre', 'like', "%{$request->input('nombre')}%")
                        ->orWhere('codigo', 'like', "%{$request->input('nombre')}%");
                });
            }
            if ($request->has('categoria_id') && $request->input('categoria_id') !== null) {
                $articulos->where('categoria_id', '=', $request->input('categoria_id'));
            }
            if ($request->has('proveedor_id') && $request->input('proveedor_id') !== null) {
                $articulos->where('proveedor_id', '=', $request->input('proveedor_id'));
            }
            if ($request->has('stock')) {
                $stock = $request->input('stock');
                if ($stock == 'Sin Stock') {
                    $articulos->where('stock', 0);
                } elseif ($stock == 'Con Stock') {
                    $articulos->where('stock', '>', 0);
                }
            }
            if ($request->has('stock_minimo')) {
                $stock_minimo = $request->input('stock_minimo');
                if ($stock_minimo == '<=') {
                    $articulos->where('stock', '<=', DB::raw('stock_minimo'));
                } elseif ($stock_minimo == '>') {
                    $articulos->where('stock', '>', DB::raw('stock_minimo'));
                }
            }
            $articulos->where('estado', 1);
            $articulos->orderBy('nombre','asc');
            $articulos = $articulos->get();

            $categorias = Categoria::where('estado', 1)->get();
            $proveedores = Proveedor::where('estado', 1)->get();
            $config = Config::first();

            return view('admin.inventario.index',compact("request", "articulos", "config","categorias", "proveedores"));
        }
    }
}

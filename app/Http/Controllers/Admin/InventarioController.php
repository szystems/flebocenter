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

use App\Exports\InventarioExport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function printinventario(Request $request)
    {
        // dd($request->all());
        if ($request)
        {
            $articulos = Articulo::query();
            if ($request->has('articulo_imprimir') && $request->input('articulo_imprimir') !== null) {
                $articulos->where(function ($query) use ($request) {
                    $query->where('nombre', 'like', "%{$request->input('articulo_imprimir')}%")
                        ->orWhere('codigo', 'like', "%{$request->input('articulo_imprimir')}%");
                });
            }
            if ($request->has('categoria_imprimir') && $request->input('categoria_imprimir') !== null) {
                $articulos->where('categoria_id', '=', $request->input('categoria_imprimir'));
            }
            if ($request->has('proveedor_imprimir') && $request->input('proveedor_imprimir') !== null) {
                $articulos->where('proveedor_id', '=', $request->input('proveedor_imprimir'));
            }
            if ($request->has('stock_imprimir')) {
                $stock = $request->input('stock_imprimir');
                if ($stock == 'Sin Stock') {
                    $articulos->where('stock', 0);
                } elseif ($stock == 'Con Stock') {
                    $articulos->where('stock', '>', 0);
                }
            }
            if ($request->has('stockminimo_imprimir')) {
                $stock_minimo = $request->input('stockminimo_imprimir');
                if ($stock_minimo == '<=') {
                    $articulos->where('stock', '<=', DB::raw('stock_minimo'));
                } elseif ($stock_minimo == '>') {
                    $articulos->where('stock', '>', DB::raw('stock_minimo'));
                }
            }
            $articulos->where('estado', 1);
            $articulos->orderBy('nombre','asc');
            $articulos = $articulos->get();

            $config = Config::first();
            $nompdf = date('Y-m-d_H-i-s');
            $path = public_path('assets/imgs/');

            $currency = $config->currency_simbol;

            if ($config->logo == null)
            {
                $logo = null;
                $imagen = null;
            }
            else
            {
                    $logo = $config->logo;
                    $imagen = public_path('assets/imgs/logos/'.$logo);
            }

            //recibir detalles de la impresion
            $pdftamaño = $request->input('pdftamaño');
            $pdfhorientacion = $request->input('pdfhorientacion');
            $pdfarchivo = $request->input('pdfarchivo');

            // dd($historia);

            if ( $pdfarchivo == "download" )
            {
                $pdf = PDF::loadView('admin.inventario.pdfinventario', compact('imagen','articulos','request','config'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->download ('Inventario - '.$nompdf.'.pdf');
            }

            if ( $pdfarchivo == "stream" )
            {
                $pdf = PDF::loadView('admin.inventario.pdfinventario', compact('imagen','articulos','request','config'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->stream ('Inventario - '.$nompdf.'.pdf');
            }
        }
    }

    public function exportinventario(Request $request)
    {
        // Crear una instancia de la clase de exportación con el request
        $export = new InventarioExport($request);

        // Obtener la colección de artículos filtrados
        $articulos = $export->collection();

        $dateExport = date('m-d-Y g:ia');

        // Retornar la vista con los datos de los artículos
        return view('admin.inventario.exportinventario', ['articulos' => $articulos]);
    }
}

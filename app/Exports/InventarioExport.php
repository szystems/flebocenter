<?php

namespace App\Exports;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Config;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventarioExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $articulos = Articulo::query();
        if ($this->request->has('articulo_imprimir') && $this->request->input('articulo_imprimir') !== null) {
            $articulos->where(function ($query) use ($request) {
                $query->where('nombre', 'like', "%{$this->request->input('articulo_imprimir')}%")
                    ->orWhere('codigo', 'like', "%{$this->request->input('articulo_imprimir')}%");
            });
        }
        if ($this->request->has('categoria_imprimir') && $this->request->input('categoria_imprimir') !== null) {
            $articulos->where('categoria_id', '=', $this->request->input('categoria_imprimir'));
        }
        if ($this->request->has('proveedor_imprimir') && $this->request->input('proveedor_imprimir') !== null) {
            $articulos->where('proveedor_id', '=', $this->request->input('proveedor_imprimir'));
        }
        if ($this->request->has('stock_imprimir')) {
            $stock = $this->request->input('stock_imprimir');
            if ($stock == 'Sin Stock') {
                $articulos->where('stock', 0);
            } elseif ($stock == 'Con Stock') {
                $articulos->where('stock', '>', 0);
            }
        }
        if ($this->request->has('stockminimo_imprimir')) {
            $stock_minimo = $this->request->input('stockminimo_imprimir');
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

        return $articulos;
    }

    public function headings(): array
    {
        return [
            'Articulo',
            'Precio',
            'Stock',
        ];
    }

    public function title(): string
    {
        return 'Inventario';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

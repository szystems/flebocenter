<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Articulo;
use App\Models\VentaDetalle;
use App\Models\Venta;

class VentasDetallesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ventas = Venta::factory()
            ->count(50)
            ->create();

        $articulos = Articulo::factory()
            ->count(50)
            ->create();

        $detalleVentas = VentaDetalle::factory()
            ->count(300)
            ->make()
            ->each(function ($detalleVenta) use ($ventas, $articulos) {
                $venta = $ventas->random();
                $articulo = $articulos->random();

                $detalleVenta->venta_id = $venta->id;
                $detalleVenta->articulo_id = $articulo->id;

                $detalleVenta->save();
            });
    }
}

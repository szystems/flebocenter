<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Articulo;
use App\Models\IngresoDetalle;
use App\Models\Ingreso;

class IngresosDetallesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingresos = Ingreso::factory()
            ->count(50)
            ->create();

        $articulos = Articulo::factory()
            ->count(50)
            ->create();

        $detalleIngresos = IngresoDetalle::factory()
            ->count(300)
            ->make()
            ->each(function ($detalleIngreso) use ($ingresos, $articulos) {
                $ingreso = $ingresos->random();
                $articulo = $articulos->random();

                $detalleIngreso->ingreso_id = $ingreso->id;
                $detalleIngreso->articulo_id = $articulo->id;

                $detalleIngreso->save();
            });
    }
}

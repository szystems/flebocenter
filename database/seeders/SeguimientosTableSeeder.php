<?php

namespace Database\Seeders;

use App\Models\Seguimiento;
use Illuminate\Database\Seeder;

class SeguimientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seguimiento::factory()->count(400)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Receta;
use Illuminate\Database\Seeder;

class RecetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Receta::factory()->count(400)->create();
    }
}

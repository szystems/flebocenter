<?php

namespace Database\Seeders;

use App\Models\Clinica;
use Illuminate\Database\Seeder;

class ClinicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clinica::factory()->count(5)->create();
    }
}

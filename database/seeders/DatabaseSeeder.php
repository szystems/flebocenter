<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClinicaSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PacienteSeeder::class);
        $this->call(CitasSeeder::class);
        $this->call(RecetasTableSeeder::class);
        $this->call(ConfigsTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(ProveedoresTableSeeder::class);
        $this->call(ArticulosTableSeeder::class);
        $this->call(IngresosDetallesSeeder::class);
    }
}

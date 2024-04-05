<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::create([
            'currency' => 'GTQ Q',
            'currency_iso' => 'GTQ',
            'currency_simbol' => 'Q',
            'email' => 'oszarata@szystems.com',
        ]);
    }
}

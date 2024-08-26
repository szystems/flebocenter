<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Otto Szarata',
            'email' => 'szystems@hotmail.com',
            'password' => Hash::make('SPP7007aaa@@@'),
            'colegiado'=> '888888',
            'role_as' => '0',
            'principal' => '1',
        ]);

        User::create([
            'name' => 'Mirla Rodriguez',
            'email' => 'flebocenter.quetgo@gmail.com',
            'password' => Hash::make('ABCD1234'),
            'colegiado'=> '16437',
            'role_as' => '0',
            'principal' => '1',
        ]);

        User::factory()->count(20)->create();
    }

}

<?php

use Illuminate\Database\Seeder;
use App\User;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['email' => 'mau@mail.com'], [
            'name' => 'Mauricio',
            'password' => bcrypt('12345678')
        ]);

        User::firstOrCreate(['email' => 'matheus@mail.com'], [
            'name' => 'Matheus',
            'password' => bcrypt('matheus')
        ]);
    }
}

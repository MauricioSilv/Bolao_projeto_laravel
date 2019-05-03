<?php

use Illuminate\Database\Seeder;
use App\Role;

class AddAclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles 
        $admin = Role::firstOrCreate(['name' => 'Admin'], [
            'description' => 'Function for administrator'
        ]); //criando o admin do sistema

        $manager = Role::firstOrCreate(['name' => 'Gerente'], [
            'description' => 'Function for manager'
        ]);

        //User com role
        $userAdmin = \App\User::findOrFail(1); // buscando na tabela o primeiro usuario
        $userManager = \App\User::findOrFail(2);

        $userAdmin->roles()->attach($admin); // fazendo o relacionamento da tabela role com o usuario
        $userManager->roles()->attach($manager);


        //permissions
        $listUser = \App\Permission::firstOrCreate(['name' => 'list-user'], [
            'description' =>'Listar usuarios'
        ]);
        $createUser = \App\Permission::firstOrCreate(['name' => 'create-user'], [
            'description' =>'Criar usuarios'
        ]);

        //role com permission

        $manager->permissions()->attach($listUser);
        $manager->permissions()->attach($createUser);


    }
}

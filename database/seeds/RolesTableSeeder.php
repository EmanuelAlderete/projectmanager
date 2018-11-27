<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 001 - System Root Administrator
        $role = Role::create(['name' => 'root', 'label' => 'With great power comes great responsibility.']);
        $role->permissions()->sync(['1', '2', '3', '4', '5', '6', '7']);

        // 002 - System Common User
        $role = Role::create(['name' => 'user', 'label' => 'Usuário comúm']);
        $role->permissions()->sync(['3']);

        // 003 - System Creator
        $role = Role::create(['name' => 'creator', 'label' => 'Usuário que cria']);
        $role->permissions()->sync(['2', '3', '4', '5']);

        // 004 - System Editor
        $role = Role::create(['name' => 'editor', 'label' => 'Usuário que edita']);
        $role->permissions()->sync(['1', '2', '3', '4', '5', '6']);

        // 005 - System Manager
        $role = Role::create(['name' => 'manager', 'label' => 'Usuário que gerencia']);
        $role->permissions()->sync(['2', '3', '4', '5', '6', '7']);
    }
}

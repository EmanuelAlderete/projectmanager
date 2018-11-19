<?php

use Illuminate\Database\Seeder;
use App\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 001
        Permission::create(['name' => 'super-admin', 'label' => 'Permissão que concede total controler ao sistema']);
        // 002
        Permission::create(['name' => 'access-menu-root', 'label' => 'Permissão que concede acesso ao menu de usuário root']);
        // 003
        Permission::create(['name' => 'access-menu', 'label' => 'Permissão que concede acesso ao menu de usuário comum']);

        // 004 - Ver tudo
        Permission::create(['name' => 'view', 'label' => 'Permissão para ler dados.']);
        // 005 - Criar tudo
        Permission::create(['name' => 'create', 'label' => 'Permissão para gravar dados.']);
        // 006 - Editar tudo
        Permission::create(['name' => 'update', 'label' => 'Permissão para editar dados.']);
        // 007 - Deletar tudo
        Permission::create(['name' => 'delete', 'label' => 'Permissão para deletar dados.']);


    }
}

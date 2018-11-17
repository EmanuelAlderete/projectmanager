<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'super-admin', 'Permissão que concede total controler ao sistema'
        ]);

        Permission::create([
            'access-menu', 'Permissão que concede acesso ao menu de usuário comum'
        ]);

        /*
        *   As permissões a seguir referem-se ao CRUD de tabelas acessíveis a todos os usuários
        *
        *   view-nome_da_tabela | Permissão de vizualizar registros da tabela especificada
        *   update-nome_da_tabela | Permissão de editar registros da tabela especificada
        *   delete-nome_da_tabela | Permissão de deletar registros da tabela especificada
        *   create-nome_da_tabela | Permissão de criar registros da tabela especificada
        *
        */

    }
}

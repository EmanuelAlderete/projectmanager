<?php

use Illuminate\Database\Seeder;
use App\TypeProject;

class TypeProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = TypeProject::create(['name' => 'Pesquisa', 'description' => 'Projeto de pesquisa é o documento que possui as idéias principais de uma pesquisa que será realizada, cada um de seus itens deve aparecer em sequência e sem mudança de folha a cada novo item']);
        $type = TypeProject::create(['name' => 'Desenvolvimento de Software', 'description' => 'Desenvolvimento de software é o ato de elaborar e implementar um sistema computacional, isto é, transformar a necessidade de um utilizador ou de um mercado em um produto de software.']);
        $type = TypeProject::create(['name' => 'Audiovisual', 'description' => 'Um projeto audiovisual é muito mais do que apenas uma câmera na mão e uma ideia na cabeça. Por se tratar de um tipo de obra que envolve muitos profissionais de especialidades diferentes, é preciso ter o projeto bem organizado na sua gênese para que ele tenha mais chances de ser produzido.']);
    }
}

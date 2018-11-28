<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 001
        Department::create([
            'name' => 'Engenharia',
            'label' => 'Engenharia é a aplicação do conhecimento científico, econômico, social e prático, com o intuito de inventar, desenhar, construir, manter e melhorar estruturas, máquinas, aparelhos, sistemas, materiais e processos. É também profissão em que se adquire e se aplicam os conhecimentos matemáticos e técnicos na criação, aperfeiçoamento e implementação de utilidades que realizem uma função ou objetivo.',
            'main_department' => 1
        ]);

        // 002
        Department::create([
            'name' => 'Sociologia',
            'label' => '#',
            'main_department' => 1
        ]);

        // 003
        Department::create([
            'name' => 'Técnologia',
            'label' => '#',
            'main_department' => 1
        ]);
    }
}

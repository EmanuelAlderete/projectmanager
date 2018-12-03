<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => 'Agropecuária',
            'label' => 'Agropecuária é a junção dos substantivos agricultura e pecuária.É utilizada por pequenos produtores que utilizam práticas tradicionais, onde o conhecimento das técnicas é repassado através de gerações. É praticada no campo e refere-se à técnicas que envolvem animais bovinos.',
            'area' => 0,
            'degree_id' => 4
        ]);

        Course::create([
            'name' => 'Informática para Internet',
            'label' => 'O curso Técnico em Informática para Internet tem o intuito de formar profissionais com capacidade de aprendizado em nível de excelência, a partir da construção de um raciocínio lógico que permita a compreensão e resolução de problemas amparados na percepção da necessidade do trabalho em equipe.',
            'area' => 0,
            'degree_id' => 4
        ]);
    }
}

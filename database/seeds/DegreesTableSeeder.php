<?php

use Illuminate\Database\Seeder;
use App\Degree;

class DegreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $degree = Degree::create(['name' => 'Superior Técnologia', 'label' => 'Os cursos de tecnólogo foram criados como uma resposta às necessidades do mercado de trabalho e, com eles, você consegue uma formação mais “acelerada”, em sintonia com o perfil profissional que as empresas estão procurando.']);
        $degree = Degree::create(['name' => 'Superior Bacharelado', 'label' => 'O bacharelado é uma formação de nível superior que confere grau de bacharel. Com duração média entre 3 e 6 anos, o curso de bacharelado prepara profissionais generalistas com sólidos conhecimentos sobre a base de uma profissão.']);
        $degree = Degree::create(['name' => 'Curso Técnico', 'label' => 'Os cursos técnicos estão em um nível entre o Ensino Médio e o Ensino Superior. Eles podem inclusive ser feitos após o Ensino Médio ou então substituir essa etapa, integrando as disciplinas práticas com as matérias do ensino médio em um só curso.']);
        $degree = Degree::create(['name' => 'Curso Técnico Integrado', 'label' => 'O Curso Técnico Integrado substitui parcialmente o Ensino Médio e pode ser iniciado logo após o aluno finalizar o Ensino Fundamental e fazer o primeiro ano do Ensino Médio.']);
    }
}

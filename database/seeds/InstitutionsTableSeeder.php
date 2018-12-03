<?php

use Illuminate\Database\Seeder;
use App\Institution;

class InstitutionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Institution::create([
            'name' => 'IFSUL - Campus Bagé',
            'about' => 'Instituição Federal de ensino de nível técnico.',
            'address' => 'Av. Leonel de Moura Brizola, 2501 - Bairro Pedra Branca - Bagé/RS - CEP 96.418-400'
        ])->courses()->sync([1, 2]);
    }
}

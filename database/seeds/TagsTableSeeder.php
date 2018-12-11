<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'informatica']);
        Tag::create(['name' => 'computadores']);
        Tag::create(['name' => 'internet']);
        Tag::create(['name' => 'ciencia']);
        Tag::create(['name' => 'tecnologia']);
        Tag::create(['name' => 'inovacao']);
        Tag::create(['name' => 'redes']);
        Tag::create(['name' => 'agro']);
        Tag::create(['name' => 'info']);
        Tag::create(['name' => 'verde']);
        Tag::create(['name' => 'meio-ambiente']);
        Tag::create(['name' => 'plantas']);
        Tag::create(['name' => 'sementes']);
        Tag::create(['name' => 'terra']);
        Tag::create(['name' => 'animais']);
        Tag::create(['name' => 'direito']);
        Tag::create(['name' => 'politica']);
        Tag::create(['name' => 'informacao']);
        Tag::create(['name' => 'noticia']);
        Tag::create(['name' => 'reportagem']);
        Tag::create(['name' => 'filosofia']);
        Tag::create(['name' => 'conhecimento']);
        Tag::create(['name' => 'criatividade']);
        Tag::create(['name' => 'habilidade']);
        Tag::create(['name' => 'programacao']);
        Tag::create(['name' => 'floricultura']);
        Tag::create(['name' => 'flores']);
        Tag::create(['name' => 'construcoes']);
        Tag::create(['name' => 'calculos']);
    }
}

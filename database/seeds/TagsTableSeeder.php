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
        Tag::create(['name' => 'informática']);
        Tag::create(['name' => 'computadores']);
        Tag::create(['name' => 'internet']);
        Tag::create(['name' => 'ciência']);
        Tag::create(['name' => 'técnologia']);
        Tag::create(['name' => 'inovação']);
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
        Tag::create(['name' => 'política']);
        Tag::create(['name' => 'informação']);
        Tag::create(['name' => 'notícia']);
        Tag::create(['name' => 'reportagem']);
        Tag::create(['name' => 'filosofia']);
        Tag::create(['name' => 'conhecimento']);
        Tag::create(['name' => 'criatividade']);
        Tag::create(['name' => 'habilidade']);
        Tag::create(['name' => 'programação']);
        Tag::create(['name' => 'floricultura']);
        Tag::create(['name' => 'flores']);
        Tag::create(['name' => 'construções']);
        Tag::create(['name' => 'cálculos']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('generos')->insert([
            'titulo' => 'Ação',
            'urlamigavel' => 'acao'
        ]);
        DB::table('generos')->insert([
            'titulo' => 'Aventura',
            'urlamigavel' => 'aventura'
        ]);
        DB::table('generos')->insert([
            'titulo' => 'Ficção Científica',
            'urlamigavel' => 'ficcao-cientifica'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ControleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('controle')->insert([
            'login' => 'caiomoizes',
            'senha' => 'caio2000',
            'nome' => 'Caio Moizés Santos',
            'foto' => 'caiomoizes.png'
        ]);
    }
}

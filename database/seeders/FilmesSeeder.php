<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('filmes')->insert([
            'titulo' => 'The Flash (2023) Torrent Dublado',
            'urlamigavel' => 'the-flash-2023-torrent-dublado',
            'tags' => 'flash,dc,1080p,mkv',
            'foto' => 'the-flash-2023-torrent-dublado.webp',
            'titulo_original' => 'The Flash',
            'titulo_traduzido' => 'The Flash',
            'lancamento' => 2023,
            'imdb' => 7.1,
            'formato' => 'MKV',
            'qualidade' => 'WEB-DL',
            'idioma' => 'Português | Inglês',
            'legenda' => 'Português',
            'tamanho' => '3.66 GB | 7.63 GB',
            'duracao' => 144,
            'qualidade_video' => 10,
            'qualidade_audio' => 10,
            'servidor' => 'Torrent',
            'sinopse' => 'The Flash é o filme solo do herói estrelado pelo ator Ezra Miller. Todo mundo já pensou em voltar no tempo para mudar alguma coisa que incomodou a vida, é por isso que Flash decide fazer o mesmo. Depois dos eventos de Liga da Justiça, Barry Allen decide viajar no tempo para evitar o assassinato de sua mãe, pelo qual seu pai foi injustamente condenado à cadeia. O que ele não imaginava seria que sua atitude teria consequências catastróficas para o universo. Ao voltar no tempo, Allen se vê em um efeito borboleta e começa a viajar entre mundos diferentes do seu. Para voltar para seu plano original, Flash contará com a ajuda de versões de heróis que já conheceu, incluindo versões do Batman que já são conhecidas (Michael Keaton e Ben Affleck), para evitar mais quebras entre universos e voltar ao normal.',
            'observacoes' => 'ADICIONADO DUAL AUDIO 10/10!!',
            'serie' => 0
        ]);
        DB::table('filmes')->insert([
            'titulo' => 'The Flash 9ª Temporada (2023) Torrent Dublado',
            'urlamigavel' => 'the-flash-9a-temporada-2023-torrent-dublado',
            'tags' => 'flash,dc,1080p,mkv',
            'foto' => 'the-flash-9a-temporada-2023-torrent-dublado.webp',
            'titulo_original' => 'The Flash',
            'titulo_traduzido' => 'The Flash',
            'lancamento' => 2023,
            'imdb' => 7.5,
            'formato' => 'MKV',
            'qualidade' => 'WEB-DL',
            'idioma' => 'Português | Inglês',
            'legenda' => 'Português',
            'tamanho' => '-',
            'duracao' => 41,
            'qualidade_video' => 10,
            'qualidade_audio' => 10,
            'servidor' => 'Torrent',
            'sinopse' => 'O investigador forense Barry Allen (Grant Gustin) sofre um acidente em seu laboratório: ele leva um banho de produtos químicos e, em seguida, é atingido por um raio. A partir disso, ele se torna capaz de canalizar os poderes do “Campo de Velocidade” e de se locomover com uma rapidez sobre-humana. De máscara e uniforme vermelhos, Barry assume a identidade do super-herói Flash e começa a usar suas habilidades para patrulhar Central City, contando com a ajuda dos cientistas da S.T.A.R. Labs. Ao mesmo tempo que detém vilões, ele procura descobrir quem está por trás do assassino de sua mãe.',
            'serie' => 1
        ]);
    }
}

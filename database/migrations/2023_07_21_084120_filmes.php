<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 80);
            $table->string('urlamigavel', 80);
            $table->string('tags');
            $table->string('foto', 80);
            $table->string('titulo_original', 80);
            $table->string('titulo_traduzido', 80);
            $table->smallInteger('lancamento');
            $table->float('imdb')->nullable();
            $table->tinyInteger('rotten_tomatoes')->nullable();
            $table->string('formato', 10);
            $table->string('qualidade', 30);
            $table->string('idioma', 40);
            $table->string('legenda', 40);
            $table->string('tamanho', 40);
            $table->smallInteger('duracao');
            $table->tinyInteger('qualidade_video');
            $table->tinyInteger('qualidade_audio');
            $table->string('servidor', 20)->nullable();
            $table->string('observacoes')->nullable();
            $table->text('sinopse');
            $table->text('resumo')->nullable();
            $table->boolean('serie')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmes');
    }
};

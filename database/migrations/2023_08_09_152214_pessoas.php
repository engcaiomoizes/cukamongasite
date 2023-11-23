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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 40);
            $table->string('urlamigavel', 40);
            $table->string('foto', 40);
            $table->timestamps();
        });
        Schema::create('filmes_has_pessoas', function (Blueprint $table) {
            $table->foreignId('filme_id')->constrained(
                table: 'filmes', indexName: 'fk_filmes_has_pessoas_filme'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pessoa_id')->constrained(
                table: 'pessoas', indexName: 'fk_filmes_has_pessoas_pessoa'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('personagem', 40)->nullable();
            $table->char('funcao', 1)->default('A'); // A -> Ator / D -> Diretor / P -> Produtor / R -> Roteirista
            $table->primary(['filme_id', 'pessoa_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

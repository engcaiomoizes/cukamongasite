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
        Schema::create('filmes_has_generos', function (Blueprint $table) {
            $table->foreignId('filme_id')->constrained(
                table: 'filmes', indexName: 'fk_filmes_has_generos_filme'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('genero_id')->constrained(
                table: 'generos', indexName: 'fk_filmes_has_generos_genero'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['filme_id', 'genero_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmes_has_generos');
    }
};

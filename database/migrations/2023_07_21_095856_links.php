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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filme_id')->constrained(
                table: 'filmes', indexName: 'links_filme_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->char('idioma', 1);
            $table->string('resolucao', 10);
            $table->string('formato', 10);
            $table->string('qualidade', 20);
            $table->string('tamanho', 10);
            $table->string('descricao', 20)->nullable();
            $table->string('link');
            $table->string('link_legenda')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};

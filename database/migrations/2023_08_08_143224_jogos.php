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
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 40);
            $table->string('urlamigavel', 40);
            $table->string('foto', 40);
            $table->smallInteger('lancamento');
            $table->text('descricao');
            $table->text('requisitos_sistema');
            $table->text('tutorial')->nullable();
            $table->text('faq')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};

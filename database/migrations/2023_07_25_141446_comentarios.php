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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filme_id')->constrained(
                table: 'filmes', indexName: 'fk_comentarios_filme'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'fk_comentarios_user'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('comentario', 255);
            $table->timestamps();
        });
        Schema::create('likes', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'fk_likes_user'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('comentario_id')->constrained(
                table: 'comentarios', indexName: 'fk_likes_comentario'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('like')->default(true);
            $table->primary(['user_id', 'comentario_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
        Schema::dropIfExists('comentarios');
    }
};

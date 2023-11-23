<form action="/controle/update-filme" method="POST" enctype="multipart/form-data" class="form-cadastro">
    @csrf
    <div class="form-control">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="{{ $filme->titulo }}" required>
    </div>
    <div class="form-control">
        <label for="tags">Tags:</label>
        <input type="text" name="tags" id="tags" value="{{ $filme->tags }}" required>
    </div>
    <input type="hidden" name="hddOldFoto" id="hddOldFoto" value="{{ $filme->foto }}">
    <div class="form-control">
        <label for="titulo">Foto:</label>
        <div style="display: block;">
            <img src="/img/{{ $filme->foto }}" style="max-width: 200px; display: block; margin-bottom: 10px;" alt="">
            <input type="file" name="foto" id="foto" required>
        </div>
    </div>
    <div class="form-control">
        <label for="titulo">Título Original:</label>
        <input type="text" name="titulo_original" id="titulo_original" value="{{ $filme->titulo_original }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Título Traduzido:</label>
        <input type="text" name="titulo_traduzido" id="titulo_traduzido" value="{{ $filme->titulo_traduzido }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Lançamento:</label>
        <input type="text" name="lancamento" id="lancamento" value="{{ $filme->lancamento }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Imdb:</label>
        <input type="text" name="imdb" id="imdb" value="{{ $filme->imdb }}">
    </div>
    <div class="form-control">
        <label for="titulo">Rotten Tomatoes:</label>
        <input type="text" name="rotten_tomatoes" id="rotten_tomatoes" value="{{ $filme->rotten_tomatoes }}">
    </div>
    <div class="form-control">
        <label for="titulo">Formato:</label>
        <input type="text" name="formato" id="formato" value="{{ $filme->formato }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Qualidade:</label>
        <input type="text" name="qualidade" id="qualidade" value="{{ $filme->qualidade }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Idioma:</label>
        <input type="text" name="idioma" id="idioma" value="{{ $filme->idioma }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Legenda:</label>
        <input type="text" name="legenda" id="legenda" value="{{ $filme->legenda }}">
    </div>
    <div class="form-control">
        <label for="titulo">Tamanho:</label>
        <input type="text" name="tamanho" id="tamanho" value="{{ $filme->tamanho }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Duração:</label>
        <input type="text" name="duracao" id="duracao" value="{{ $filme->duracao }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Qualidade de Vídeo:</label>
        <input type="text" name="qualidade_video" id="qualidade_video" value="{{ $filme->qualidade_video }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Qualidade de Áudio:</label>
        <input type="text" name="qualidade_audio" id="qualidade_audio" value="{{ $filme->qualidade_audio }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Servidor:</label>
        <input type="text" name="servidor" id="servidor" value="{{ $filme->servidor }}" required>
    </div>
    <div class="form-control">
        <label for="titulo">Sinopse:</label>
        <textarea name="sinopse" id="sinopse" cols="30" rows="10" required>{{ $filme->sinopse }}</textarea>
    </div>
    <div class="form-control">
        <label for="titulo">Resumo:</label>
        <textarea name="resumo" id="resumo" cols="30" rows="10">{{$filme->resumo }}</textarea>
    </div>
    <div class="form-control">
        <label for="titulo">Observações:</label>
        <input type="text" name="observacoes" id="observacoes" value="{{ $filme->observacoes }}">
    </div>
    <div class="form-control">
        <input type="submit" class="btn-primary" value="Salvar">
    </div>
</form>
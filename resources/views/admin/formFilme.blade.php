<form action="/controle/store-filme" method="POST" enctype="multipart/form-data" class="form-cadastro">
                @csrf
                <div class="form-control">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" id="titulo" required>
                </div>
                <div class="form-control">
                    <label for="tags">Tags:</label>
                    <input type="text" name="tags" id="tags" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Foto:</label>
                    <input type="file" name="foto" id="foto" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Título Original:</label>
                    <input type="text" name="titulo_original" id="titulo_original" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Título Traduzido:</label>
                    <input type="text" name="titulo_traduzido" id="titulo_traduzido" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Lançamento:</label>
                    <input type="text" name="lancamento" id="lancamento" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Imdb:</label>
                    <input type="text" name="imdb" id="imdb">
                </div>
                <div class="form-control">
                    <label for="titulo">Rotten Tomatoes:</label>
                    <input type="text" name="rotten_tomatoes" id="rotten_tomatoes">
                </div>
                <div class="form-control">
                    <label for="titulo">Formato:</label>
                    <input type="text" name="formato" id="formato" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Qualidade:</label>
                    <input type="text" name="qualidade" id="qualidade" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Idioma:</label>
                    <input type="text" name="idioma" id="idioma" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Legenda:</label>
                    <input type="text" name="legenda" id="legenda">
                </div>
                <div class="form-control">
                    <label for="titulo">Tamanho:</label>
                    <input type="text" name="tamanho" id="tamanho" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Duração:</label>
                    <input type="text" name="duracao" id="duracao" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Qualidade de Vídeo:</label>
                    <input type="text" name="qualidade_video" id="qualidade_video" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Qualidade de Áudio:</label>
                    <input type="text" name="qualidade_audio" id="qualidade_audio" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Servidor:</label>
                    <input type="text" name="servidor" id="servidor" required>
                </div>
                <div class="form-control">
                    <label for="titulo">Sinopse:</label>
                    <textarea name="sinopse" id="sinopse" cols="30" rows="10" required></textarea>
                </div>
                <div class="form-control">
                    <label for="titulo">Resumo:</label>
                    <textarea name="resumo" id="resumo" cols="30" rows="10"></textarea>
                </div>
                <div class="form-control">
                    <label for="titulo">Observações:</label>
                    <input type="text" name="observacoes" id="observacoes">
                </div>
                @if($url == 'form-filme')
                <input type="hidden" name="serie" required value="0">
                @else
                <input type="hidden" name="serie" required value="1">
                @endif
                <div class="form-control">
                    <input type="submit" class="btn-primary" value="Cadastrar">
                </div>
            </form>
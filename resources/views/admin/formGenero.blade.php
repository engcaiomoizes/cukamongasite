<form action="/controle/store-genero" method="POST" class="form-cadastro">
    @csrf
    <div class="form-control">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>
    </div>
    <div class="form-control">
        <input type="submit" class="btn-primary" value="Cadastrar">
    </div>
</form>
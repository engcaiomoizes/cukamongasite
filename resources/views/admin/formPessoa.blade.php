<form action="/controle/store-pessoa" method="POST" enctype="multipart/form-data" class="form-cadastro">
    @csrf
    <div class="form-control">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
    </div>
    <div class="form-control">
        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto">
    </div>
    <div class="form-control">
        <input type="submit" class="btn-primary" value="Cadastrar">
    </div>
</form>
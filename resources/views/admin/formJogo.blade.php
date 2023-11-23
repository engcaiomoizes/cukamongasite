<!-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script> -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<form action="/controle/store-jogo" method="POST" enctype="multipart/form-data" class="form-cadastro">
    @csrf
    <div class="form-control">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo">
    </div>
    <div class="form-control">
        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto">
    </div>
    <div class="form-control">
        <label for="lancamento">Lançamento:</label>
        <input type="text" name="lancamento" id="lancamento">
    </div>
    <div class="form-control">
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao"></textarea>
    </div>
    <div class="form-control">
        <label for="requisitos_sistema">Requisitos de Sistema:</label>
        <textarea name="requisitos_sistema" id="requisitos_sistema"></textarea>
    </div>
    <div class="form-control">
        <label for="tutorial">Tutorial:</label>
        <textarea name="tutorial" id="tutorial"></textarea>
    </div>
    <div class="form-control">
        <label for="faq">FAQ:</label>
        <textarea name="faq" id="faq"></textarea>
    </div>
    <div class="form-control">
        <input type="submit" class="btn-primary" value="Cadastrar">
    </div>
</form>
<script>
    // ClassicEditor
    //     .create(document.querySelector('#descricao'))
    //     .then(editor => {
    //         console.log(editor);
    //     }).catch( error => {
    //         console.error(error);
    //     });
    CKEDITOR.replace('descricao');
    CKEDITOR.replace('requisitos_sistema');
    CKEDITOR.replace('tutorial');
    CKEDITOR.replace('faq');
</script>
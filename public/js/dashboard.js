function excluirFilme(id) {
    if (confirm("Deseja realmente excluir este filme?")) {
        document.getElementById('form-delete-' + id).submit();
    } else {
        //
    }
}
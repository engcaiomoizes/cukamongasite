const openModalButton = document.querySelector("#open-modal");
const closeModalButton = document.querySelector("#close-modal");
const modal = document.querySelector("#modal");
const fade = document.querySelector("#fade");

const openLinksButton = document.querySelector("#open-links");
const closeLinksButton = document.querySelector("#close-links");
const modalLinks = document.querySelector("#links");
const fadeLinks = document.querySelector("#fade-links");
const formLinks = document.querySelector("#form-links");
const linksData = document.querySelector("#links-data");

const fadePessoas = document.querySelector("#fade-pessoas");
const modalPessoas = document.querySelector("#pessoas");
const closePessoasButton = document.querySelector("#close-pessoas");

const fadeComments = document.querySelector("#fade-comments");
const modalComments = document.querySelector("#comments");
const closeCommentsButton = document.querySelector("#close-comments");

const togglePessoas = () => {
    fadePessoas.classList.add("hide");
    modalPessoas.classList.add("hide");
}

[closePessoasButton, fadePessoas].forEach((el) => {
    el.addEventListener("click", () => {
        togglePessoas();
    });
});

function showPessoas(id) {
    $.get("/controle/get-pessoas/?id=" + id, function(data) {
        $("#pessoas-data").empty();
        data.forEach(pessoa => {
            $("#pessoas-data").html(
                $("#pessoas-data").html() + 
                "<div class='separator'>" +
                "<b>Nome: </b>" + pessoa.nome + "<br>" +
                "<b>Personagem: </b>" + pessoa.personagem +
                "</div>"
            );
        });
    });
    $("#hddFilmePessoa").val(id);
    modalPessoas.classList.remove("hide");
    fadePessoas.classList.remove("hide");
}

const toggleComments = () => {
    fadeComments.classList.add("hide");
    modalComments.classList.add("hide");
}

[closeCommentsButton, fadeComments].forEach((el) => {
    el.addEventListener("click", () => {
        toggleComments();
    });
});

const toggleModal = () => {
    modal.classList.add("hide");
    fade.classList.add("hide");
}

[closeModalButton, fade].forEach((el) => {
    el.addEventListener("click", () => {
        toggleModal();
    });
});

const toggleLinks = () => {
    modalLinks.classList.add("hide");
    fadeLinks.classList.add("hide");
}

[closeLinksButton, fadeLinks].forEach((el) => {
    el.addEventListener("click", () => {
        toggleLinks();
    });
});

function exibir(tela) {
    if (tela == "list") {
        formLinks.classList.add("hide");
        linksData.classList.remove("hide");
    } else if (tela == 'form') {
        linksData.classList.add("hide");
        formLinks.classList.remove("hide");
    }
}

function showFilme(id) {
    $.get("/controle/get-filme/?id=" + id, function(data) {
        $('#titulo').empty().html(data.titulo);
        $('#modal-data').empty().html(
            "<b>Título Original:</b> " + data.titulo_original + "<br>" +
            "<b>Título Traduzido:</b> " + data.titulo_traduzido + "<br>" +
            "<b>Lançamento:</b> " + data.lancamento + "<br>" +
            "<b>Imdb:</b> " + data.imdb + "<br>" +
            "<b>Rotten Tomatoes: </b>" + data.rotten_tomatoes + "<br>" +
            "<b>Formato: </b>" + data.formato + "<br>" +
            "<b>Qualidade: </b>" + data.qualidade + "<br>" +
            "<b>Idioma: </b>" + data.idioma + "<br>" +
            "<b>Legenda: </b>" + data.legenda + "<br>" +
            "<b>Tamanho: </b>" + data.tamanho + "<br>" +
            "<b>Duração: </b>" + data.duracao + "<br>" +
            "<b>Qualidade de Vídeo: </b>" + data.qualidade_video + "<br>" +
            "<b>Qualidade de Áudio: </b>" + data.qualidade_audio + "<br>" +
            "<b>Servidor: </b>" + data.servidor + "<br>" +
            "<b>Sinopse: </b>" + data.sinopse + "<br>" +
            "<b>Resumo: </b>" + data.resumo + "<br>" +
            "<b>Observações: </b>" + data.observacoes
        );
    });
    modal.classList.remove('hide');
    fade.classList.remove('hide');
}

function showComments(id) {
    $.get("/controle/get-comments/?id=" + id, function(data) {
        $('#comments-data').empty();
        var dataComentario;

        data.forEach(comment => {
            dataComentario = new Date(comment.created_at);
            $('#comments-data').html(
                $('#comments-data').html() +
                "<div class='separator'>" +
                "<b>Nome: </b>" + comment.name + "<br>" +
                "<b>Comentário: </b>" + comment.comentario + "<br>" +
                "<b>Data: </b>" + dataComentario.toLocaleString() +
                "</div>"
            );
        });
    });
    fadeComments.classList.remove("hide");
    modalComments.classList.remove("hide");
}

function showLinks(id) {
    $.get("/controle/get-links/?id=" + id, function(data) {
        $('#hddFilme').val(id);
        $('#links-data').empty();
        var idioma;
        
        data.forEach(link => {
            switch (link.idioma) {
                case 'A': idioma = 'Dual Audio'; break;
                case 'D': idioma = 'Dublado'; break;
                case 'L': idioma = 'Legendado'; break;
            }
            $('#links-data').html(
                $('#links-data').html() +
                "<div class='separator'>" +
                "<b>Idioma: </b>" + idioma + "<br>" +
                "<b>Resolução: </b>" + link.resolucao + "<br>" +
                "<b>Formato: </b>" + link.formato + "<br>" +
                "<b>Qualidade: </b>" + link.qualidade + "<br>" +
                "<b>Tamanho: </b>" + link.tamanho + "<br>" +
                "<b>Descrição: </b>" + link.descricao + "<br>" +
                "<a href='javascript:void(0);' onclick='excluir(" + link.id + ", " + link.filme_id + ");'>Excluir</a>" +
                "</div>"
            );
        });
    });
    modalLinks.classList.remove("hide");
    fadeLinks.classList.remove("hide");
}

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    }
});

function excluir(id, filme_id) {
    var el = this;
    if (confirm("Deseja realmente excluir este link?")) {
        $.ajax({
            url: "/controle/excluir-link",
            type: "POST",
            data: { id: id },
            success: function(response) {
                // console.log(response);
                if (response == 1) {
                    showLinks(filme_id);
                } else {
                    //
                }
            }
        });
    } else {
        //
    }
}
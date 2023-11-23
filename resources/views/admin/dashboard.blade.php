<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cukamonga Filmes</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <script src="/js/modal.js" defer></script>
    <script src="/js/dashboard.js" defer></script>
    <script src="https://kit.fontawesome.com/99b07ad12a.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<body style="background-color: rgba(0,0,0,.2) !important;">

    <div class="dashboard">
        <menu>
            <div class="options">
                <h4>Cukamonga Site</h4>
                <a href="javascript:void(0);" style="right: 40px;" title="Notificações"><i class="fa-solid fa-bell"></i></a>
                <a href="/controle/logout" title="Sair"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
            <div class="foto">
                <img src="/img/users/{{ $data->foto }}" alt="" />
            </div>
            <h3>{{ $data->nome }}</h3>
            <ul>
                <li><a href="/controle/dashboard">Dashboard</a></li>
                <li><a href="/controle/filmes">Filmes</a></li>
                <li><a href="/controle/series">Séries</a></li>
                <li><a href="/controle/generos">Gêneros</a></li>
                <li><a href="/controle/pessoas">Pessoas</a></li>
                <li><a href="/controle/usuarios">Usuários</a></li>
            </ul>
        </menu>
        <div class="container-dashboard" style="@if($url == 'dashboard') text-align: center; @endif">
            @if(Session::has('success'))
            <div class="alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @if($url == 'dashboard')
            <div class="box">
                <h1>{{ $filmes->count() }}</h1>
                <h2>Filme{{ ($filmes->count() != 1) ? 's' : '' }}</h2>
            </div>
            <div class="box">
                <h1>{{ $series->count() }}</h1>
                <h2>Série{{ ($series->count() != 1) ? 's' : '' }}</h2>
            </div>
            <div class="box">
                <h1>{{ $users->count() }}</h1>
                <h2>Usuário{{ ($users->count() != 1) ? 's' : '' }}</h2>
            </div>
            <div class="box">
                <h1>{{ $generos->count() }}</h1>
                <h2>Gênero{{ ($generos->count() != 1) ? 's' : '' }}</h2>
            </div>
            @elseif($url == 'filmes')
            <a href="/controle/form-filme"><button class="btn-primary">Cadastrar</button></a>
            <table>
                <tr>
                    <th>Título</th>
                    <th width=20>Lançamento</th>
                    <th width=250>Idioma</th>
                    <th width=150>Qualidade</th>
                    <th>Ações</th>
                </tr>
                @if($filmes->count() > 0)
                @foreach($filmes as $filme)
                <tr>
                    <td>{{ $filme->titulo }}</td>
                    <td>{{ $filme->lancamento }}</td>
                    <td>{{ $filme->idioma }}</td>
                    <td>{{ $filme->qualidade }}</td>
                    <td style="width: 160px;">
                        <a href="javascript:void(0);" class="open-modal" id="open-modal" onclick="showFilme(<?= $filme->id; ?>)" title="Visualizar"><i class="fa-solid fa-eye"></i></a>
                        <a href="/controle/edit-filme/<?= $filme->id; ?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="javascript:void(0);" class="open-modal" id="open-links" onclick="showLinks(<?= $filme->id; ?>)" title="Links"><i class="fa-solid fa-link"></i></a>
                        <a href="/controle/form-filme-genero/{{ $filme->id }}" title="Gêneros"><i class="fa-solid fa-film"></i></a>
                        <a href="javascript:void(0);" class="open-modal" id="open-pessoas" onclick="showPessoas(<?= $filme->id; ?>);" title="Pessoas"><i class="fa-solid fa-user"></i></a>
                        <a href="javascript:void(0);" id="open-comments" onclick="showComments(<?= $filme->id; ?>);" title="Comentários"><i class="fa-solid fa-comment"></i></a>
                        <form id="form-delete-<?= $filme->id; ?>" style="display: inline-block;" action="/controle/excluir-filme" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="<?= $filme->id; ?>">
                            <a href="javascript:void(0);" onclick="excluirFilme(<?= $filme->id; ?>);" title="Excluir"><i class="fa-solid fa-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" align="center">Nenhum filme cadastrado!</td>
                </tr>
                @endif
            </table>
            @elseif($url == 'series')
            <a href="/controle/form-serie"><button class="btn-primary">Cadastrar</button></a>   
            <table>
                <tr>
                    <th>Título</th>
                    <th width=20>Lançamento</th>
                    <th width=250>Idioma</th>
                    <th width=150>Qualidade</th>
                    <th>Ações</th>
                </tr>
                @if($series->count() > 0)
                @foreach($series as $serie)
                <tr>
                    <td>{{ $serie->titulo }}</td>
                    <td>{{ $serie->lancamento }}</td>
                    <td>{{ $serie->idioma }}</td>
                    <td>{{ $serie->qualidade }}</td>
                    <td style="width: 160px;">
                        <a href="javascript:void(0);" class="open-modal" id="open-modal" onclick="showFilme(<?= $serie->id; ?>)" title="Visualizar"><i class="fa-solid fa-eye"></i></a>
                        <a href="/controle/edit-filme/<?= $serie->id; ?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="javascript:void(0);" class="open-modal" id="open-links" onclick="showLinks(<?= $serie->id; ?>)" title="Links"><i class="fa-solid fa-link"></i></a>
                        <a href="/controle/form-filme-genero/{{ $serie->id }}" title="Gêneros"><i class="fa-solid fa-film"></i></a>
                        <a href="javascript:void(0);" class="open-modal" id="open-pessoas" onclick="showPessoas(<?= $serie->id; ?>);" title="Pessoas"><i class="fa-solid fa-user"></i></a>
                        <a href="javascript:void(0);" id="open-comments" onclick="showComments(<?= $serie->id; ?>);" title="Comentários"><i class="fa-solid fa-comment"></i></a>
                        <form id="form-delete-<?= $serie->id; ?>" style="display: inline-block;" action="/controle/excluir-filme" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="<?= $serie->id; ?>">
                            <a href="javascript:void(0);" onclick="excluirFilme(<?= $serie->id; ?>);" title="Excluir"><i class="fa-solid fa-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" align="center">Nenhuma série cadastrada!</td>
                </tr>
                @endif
            </table>
            @elseif($url == 'usuarios')
            <a href="/controle/form-usuario"><button class="btn-primary">Cadastrar</button></a>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Data de cadastro</th>
                    <th>Ações</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->nome }}</td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="#"><i class="fa-solid fa-eye"></i></a>
                        <a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#"><i class="fa-solid fa-link"></i></a>
                        <a href="#"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
            @elseif($url == 'generos')
            <a href="/controle/form-genero"><button class="btn-primary">Cadastrar</button></a>
            <table>
                <tr>
                    <th>Gênero</th>
                    <th>Ações</th>
                </tr>
                @if($generos->count() > 0)
                @foreach($generos as $genero)
                <tr>
                    <td>{{ $genero->titulo }}</td>
                    <td>
                        <a href="#"><i class="fa-solid fa-eye"></i></a>
                        <a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#"><i class="fa-solid fa-link"></i></a>
                        <a href="#"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" align="center">Nenhum gênero cadastrado!</td>
                </tr>
                @endif
            </table>
            @elseif($url == 'pessoas')
            <a href="/controle/form-pessoa"><button class="btn-primary">Cadastrar</button></a>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                @if($pessoas->count() > 0)
                @foreach($pessoas as $pessoa)
                <tr>
                    <td>{{ $pessoa->nome }}</td>
                    <td>
                        <a href="javascript:void(0);" class="open-modal" id="open-modal" onclick="" title="Visualizar"><i class="fa-solid fa-eye"></i></a>
                        <a href="/controle/edit-pessoa/<?= $pessoa->id; ?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form id="form-delete-<?= $pessoa->id; ?>" style="display: inline-block;" action="/controle/excluir-filme" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="<?= $pessoa->id; ?>">
                            <a href="javascript:void(0);" onclick="excluirPessoa(<?= $pessoa->id; ?>);" title="Excluir"><i class="fa-solid fa-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" align="center">Nenhuma pessoa cadastrada!</td>
                </tr>
                @endif
            </table>
            @elseif($url == 'form-filme' || $url == 'form-serie')
            @include('admin.formFilme')
            @elseif($url == 'form-genero')
            @include('admin.formGenero')
            @elseif($url == 'form-usuario')
            @include('admin.formUsuario')
            @elseif($url == 'form-filme-genero' && isset($id))
            @include('admin.formFilmeGenero')
            @elseif($url == 'edit-filme' && isset($id))
            @include('admin.editFilme')
            @elseif($url == 'form-pessoa')
            @include('admin.formPessoa')
            @elseif($url == 'form-jogo')
            @include('admin.formJogo')
            @else
            <h1>Página não encontrada!</h1>
            @endif
            <div id="fade" class="fade hide"></div>
            <div id="modal" class="modal hide">
                <div class="modal-header">
                    <h2 id="titulo"></h2>
                    <button id="close-modal">Fechar</button>
                </div>
                <div class="modal-body">
                    <p id="modal-data"></p>
                </div>
            </div>
            <div id="fade-pessoas" class="fade hide"></div>
            <div id="pessoas" class="modal hide">
                <div class="modal-header">
                    <h2>Pessoas</h2>
                    <button id="close-pessoas">Fechar</button>
                </div>
                <div class="modal-body">
                    <form action="/controle/store-filme-pessoa" method="POST" class="form-cadastro">
                        @csrf
                        <input type="hidden" name="filme" id="hddFilmePessoa" value="">
                        <div class="form-control">
                            <label for="pessoa">Pessoa:</label>
                            <select name="pessoa" id="pessoa">
                                <option>Selecione</option>
                                @if($pessoas->count() > 0)
                                @foreach($pessoas as $pessoa)
                                <option value="{{ $pessoa->id }}">{{ $pessoa->nome }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-control">
                            <label for="personagem">Personagem:</label>
                            <input type="text" name="personagem" id="personagem">
                        </div>
                        <div class="form-control">
                            <label for="funcao">Função:</label>
                            <select name="funcao" id="funcao">
                                <option value="A">Ator</option>
                                <option value="D">Diretor</option>
                                <option value="P">Produtor</option>
                                <option value="R">Roteirista</option>
                            </select>
                        </div>
                        <input type="submit" class="btn-primary" value="Cadastrar">
                    </form>
                    <p id="pessoas-data"></p>
                </div>
            </div>
            <div id="fade-comments" class="fade hide"></div>
            <div id="comments" class="modal hide">
                <div class="modal-header">
                    <h2>Comentários</h2>
                    <button id="close-comments">Fechar</button>
                </div>
                <div class="modal-body">
                    <p id="comments-data"></p>
                </div>
            </div>
            <div id="fade-links" class="fade hide"></div>
            <div id="links" class="modal hide">
                <div class="modal-header">
                    <h2 id="links-titulo">Links</h2>
                    <button id="close-links">Fechar</button>
                </div>
                <div class="modal-body">
                    <button onclick="exibir('list');">Lista</button>
                    <button onclick="exibir('form');">Formulário</button>
                    <form action="/controle/store-link" method="POST" class="form-cadastro hide" id="form-links">
                        @csrf
                        <input type="hidden" name="hddFilme" id="hddFilme">
                        <div class="form-control">
                            <label for="idioma">Idioma:</label>
                            <select name="idioma" id="idioma">
                                <option value="A">Dual Audio</option>
                                <option value="D">Dublado</option>
                                <option value="L">Legendado</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label for="resolucao">Resolução:</label>
                            <input type="text" name="resolucao" id="resolucao">
                        </div>
                        <div class="form-control">
                            <label for="formato">Formato:</label>
                            <input type="text" name="formato" id="formato">
                        </div>
                        <div class="form-control">
                            <label for="qualidade">Qualidade:</label>
                            <input type="text" name="qualidade" id="qualidade">
                        </div>
                        <div class="form-control">
                            <label for="tamanho">Tamanho:</label>
                            <input type="text" name="tamanho" id="tamanho">
                        </div>
                        <div class="form-control">
                            <label for="descricao">Descrição:</label>
                            <input type="text" name="descricao" id="descricao">
                        </div>
                        <div class="form-control">
                            <label for="link">Link:</label>
                            <input type="text" name="link" id="link">
                        </div>
                        <div class="form-control">
                            <label for="link_legenda">Link Legenda:</label>
                            <input type="text" name="link_legenda" id="link_legenda">
                        </div>
                        <div class="form-control">
                            <input type="submit" class="btn-primary" value="Cadastrar">
                        </div>
                    </form>
                    <div id="links-data" class="links-data"></div>
                </div>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        // showFilme();
    });
</script>
</html>
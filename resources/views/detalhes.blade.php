@extends('layouts.main')

@section('title', 'Cukamonga Site')

@section('imports')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/css/content.css">
<script src="https://kit.fontawesome.com/99b07ad12a.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="/js/scripts.js" defer></script>
@endsection

@section('content')
<div class="container-title">
    <h1>{{ $filme->titulo }}</h1>
    <div class="marcadores">
        <p>
            <i class="fa-solid fa-tags"></i>
            @foreach(explode(',', $filme->tags) as $tag)
                <a style="color: #fff;" href="/?s={{ $tag }}">{{ $tag }}</a>,
            @endforeach
        </p>
    </div>
</div>
<div class="row">
    <div class="left">
        <div class="content">
            <div class="seals">
                <div class="favorite">
                    <i class="fa-solid fa-star"></i>
                    <strong>Ctrl+D</strong>
                    <span>para adicionar aos favoritos</span>
                </div>
                <div class="attention">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <strong>Link Off?</strong>
                    <span>nos avise nos comentários</span>
                </div>
                <div class="text">
                    <small>Não hospedamos nenhum arquivo, todos são encontrados livremente na internet!</small>
                </div>
            </div>
            <div class="entry-content cf">
                <div class="entry-content cf">
                    <p style="text-align: left;">
                        <strong><span style="color: #0000ff;">
                            <a style="clear: left; float: left; margin-bottom: 1em; margin-right: 1em;" target="_blank" rel="nofollow">
                                <img decoding="async" loading="lazy" class="" style="border-radius: 10px; border: 0px none;" title="{{ $filme->titulo }}" src="/img/{{ $filme->foto }}" alt="#" width="260" height="382" border="0">
                            </a>
                            »INFORMAÇÕES«
                        </span></strong><br>
                        <b>Título Original:</b>&nbsp;{{ $filme->titulo_original }}<b><br>
                        Titulo Traduzido:</b>&nbsp;{{ $filme->titulo_traduzido }}<br>
                        <strong>Lançamento</strong>:&nbsp;<a href="/{{ $filme->lancamento }}">{{ $filme->lancamento }}</a><br>
                        <b>Gênero</b>: @foreach($generos as $genero) <a href="/{{ $genero->urlamigavel }}">{{ $genero->titulo }}</a> | @endforeach<br>
                        <b>Formato:</b>&nbsp;{{ $filme->formato }}<br>
                        <b>Qualidade:</b>&nbsp;{{  $filme->qualidade }}<br>
                        <b>Idioma</b>: {{ $filme->idioma }}<br>
                        <strong>Legenda</strong>: {{ $filme->legenda }}<br>
                        <b>Tamanho:</b>&nbsp;{{ $filme->tamanho }}<br>
                        <b>Duração:</b>&nbsp;{{ $filme->duracao }} min.<br>
                        <b>Qualidade de Vídeo:</b> {{ $filme->qualidade_video }}<br>
                        <b>Qualidade de Áudio:</b> {{ $filme->qualidade_audio }}<br>
                        <b>Servidor:&nbsp;</b>{{ $filme->servidor }}<br>
                        <span style="color: #008000;"><strong>{{ $filme->observacoes }}</strong></span>
                    </p>
                    <p style="text-align: left;"><span id="more-2118"></span><strong><span style="color: #0000ff;">Sinopse</span></strong>: {{ $filme->sinopse }}</p>
                </div>
            </div>

            <div class="links">
                <h2>Downloads</h2>
                @if($links->count() > 0)
                @if($links->contains('idioma', 'A'))
                <div class="box">
                    <h3>Dual Áudio</h3>
                    <table>
                        @foreach($links as $link)
                        @if($link->idioma == 'A')
                        <tr>
                            <td>{{ $link->descricao }}</td>
                            <td>{{ $link->resolucao }}</td>
                            <td>{{ $link->formato }}</td>
                            <td>{{ $link->qualidade }}</td>
                            <td>{{ $link->tamanho }}</td>
                            <td><a href="{{ $link->link }}" target="_blank">Baixar</a></td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
                @endif
                @if($links->contains('idioma', 'D'))
                <div class="box">
                    <h3>Dublado</h3>
                    <table>
                        @foreach($links as $link)
                        @if($link->idioma == 'D')
                        <tr>
                            <td>{{ $link->resolucao }}</td>
                            <td>{{ $link->formato }}</td>
                            <td>{{ $link->qualidade }}</td>
                            <td>{{ $link->tamanho }}</td>
                            <td><a href="{{ $link->link }}" target="_blank">Baixar</a></td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
                @endif
                @if($links->contains('idioma', 'L'))
                <div class="box">
                    <h3>Legendado</h3>
                    <table>
                        @foreach($links as $link)
                        @if($link->idioma == 'L')
                        <tr>
                            <td>{{ $link->resolucao }}</td>
                            <td>{{ $link->formato }}</td>
                            <td>{{ $link->qualidade }}</td>
                            <td>{{ $link->tamanho }}</td>
                            <td><a href="{{ $link->link }}" target="_blank">Baixar</a></td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
                @endif
                @else
                <span style="color: red; font-weight: bold;">Em Breve!</span>
                @endif
            </div>
            @if($pessoas->count() > 0)
            <div class="elenco">
                <h2>Elenco</h2>
                @foreach($pessoas as $pessoa)
                <div class="box-pessoa">
                    <a href="/pessoa/{{ $pessoa->urlamigavel }}"><img src="/img/pessoas/{{ $pessoa->foto }}" alt=""></a>
                    <div>
                        <a href="/pessoa/{{ $pessoa->urlamigavel }}"><span style="display: block; font-weight: bold;">{{ $pessoa->nome }}</span></a>
                        <span style="font-size: 14px;">{{ $pessoa->personagem }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            <div class="seals bottom">
                <div class="favorite">
                    <i class="fa-solid fa-star"></i>
                    <strong>Ctrl+D</strong>
                    <span>para adicionar aos favoritos</span>
                </div>
                <div class="seed">
                    <i class="fa-solid fa-right-left"></i>
                    <strong>Ajude a semear</strong>
                    <span>e agradeça :)</span>
                </div>
                <div class="text">
                    <i class="fa-solid fa-signal"></i>
                    <small> visualizações</small>
                </div>
            </div>
        </div>
        <div class="comments">
            <div class="title">
                <h4>{{ $comentarios->count() }} Comentário{{ ($comentarios->count() != 1) ? 's' : '' }}</h4>
            </div>
            @if(!Auth::check())
                <a href="{{ route('social.login', ['provider' => 'github']) }}">Login</a>
            @else
                @if(Session::has('success'))
                <div class="alert-success">{{ Session::get('success') }}</div>
                @endif
                @if(Session::has('fail'))
                <div class="alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <form class="comment-form" action="/enviar-comentario" method="POST">
                    @csrf
                    <span class="logado">Logado como&nbsp;<b>{{ Auth::getUser()->name }}</b></span>
                    <a href="/logout">Sair</a>
                    <textarea name="comentario" id="comentario"></textarea>
                    <input type="hidden" name="hddIdFilme" id="hddIdFilme" value="{{ $filme->id }}">
                    <input type="hidden" name="hddIdUser" id="hddIdUser" value="{{ Auth::getUser()->id }}">
                    <span>Caracteres restantes: 255</span>
                    <input type="submit" class="comment-submit" value="Comentar">
                </form>
            @endif
            @foreach($comentarios as $comentario)
            <div class="comment-box">
                <img src="{{ $comentario->avatar }}" alt="">
                <div class="comment-content">
                    <div class="comment-owner">
                        <h2>{{ $comentario->name }}</h2>
                        <span>{{ date('d/m/Y H:i:s', strtotime($comentario->created_at)) }}</span>
                    </div>
                    <p class="comment-text">
                        {{ $comentario->comentario }}
                    </p>
                    <div class="comment-footer">
                        <a href="javascript:void(0);" onclick="like(<?= auth()->check(); ?>, {{ $comentario->id }}, {{ Auth::getUser() ? Auth::getUser()->id : 0 }});"><i class="fa-solid fa-thumbs-up"></i></a> {{ $comentario->likes }}
                        <a href="javascript:void(0);" onclick="dislike();"><i class="fa-solid fa-thumbs-down"></i></a> {{ $comentario->dislikes }}
                        <span>Responder</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <aside class="right">
        <div class="main_title">
            <h4>Filmes e Séries Relacionados</h4>
        </div>
        <div class="post_list">
            <div class="row">
                @foreach($relacionados as $rel)
                <div class="post">
                    <div class="inner">
                        <div class="thumb">
                            <a href="/{{ $rel->urlamigavel }}/">
                                <div class="tags">
                                    <div>{{ $rel->lancamento }}</div>
                                    @if(str_contains($rel->tags, '1080p'))
                                        <div>1080p</div>
                                    @endif
                                </div>
                                <div class="img" style="background-image:url(/img/<?= $rel->foto; ?>);"></div>
                            </a>
                        </div>
                        <div class="title">
                            <a href="/{{ $rel->urlamigavel }}/">
                                {{ $rel->titulo }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </aside>
</div>
<script>
    window.onload = function() {
        // Verifica se o usuário logado deu like em algum comentário
        var logado = <?= auth()->check() ? auth()->user()->id : null; ?>;
        alert(logado);
    }
</script>
@endsection
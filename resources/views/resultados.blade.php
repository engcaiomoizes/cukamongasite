@extends('layouts.main')

@section('title', 'Cukamonga Site')

@section('imports')
<link rel="stylesheet" href="/css/content.css">
@endsection

@section('content')
<div class="container-resultados">
    <div class="main_title">
        <h1><b>{{ $main_title }}</b></h1>
    </div>
    <div class="post_list">
        <div class="row">
            @foreach($filmes as $filme)
            <div class="post">
                <div class="inner">
                    <div class="thumb">
                        <a href="/{{ $filme->urlamigavel }}/">
                            <div class="tags">
                                <div>{{ $filme->lancamento }}</div>
                                @if(str_contains($filme->tags, '1080p'))
                                <div>1080p</div>
                                @endif
                            </div>
                            <div class="img" style="background-image:url(/img/<?= $filme->foto; ?>);"></div>
                        </a>
                    </div>
                    <div class="title">
                        <a href="/{{ $filme->urlamigavel }}/">
                            {{ $filme->titulo }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
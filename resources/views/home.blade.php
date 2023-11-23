@extends('layouts.main')

@section('title', 'Cukamonga Caio')

@section('imports')
<link rel="stylesheet" href="/css/content.css">
@endsection

@section('content')
@if(app('request')->input('s'))
<div class="container-resultados">
    <div class="main_title">
        <h1>Resultados para <b>{{ app('request')->input('s') }}</b></h1>
    </div>
    <div class="post_list">
        <div class="row">
            @foreach($resultados as $resultado)
            <div class="post">
                <div class="inner">
                    <div class="thumb">
                        <a href="/{{ $resultado->urlamigavel }}">
                            <div class="tags"><div>{{ $resultado->lancamento }}</div><div>1080p</div></div>
                            <div class="img" style="background-image: url(/img/<?= $resultado->foto; ?>);"></div>
                        </a>
                    </div>
                    <div class="title">
                        <a href="/{{ $resultado->urlamigavel }}">
                            {{ $resultado->titulo }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
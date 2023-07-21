<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/style.css">
    @yield('imports')
</head>
<body>
    <header>
        <div class="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Filmes</a></li>
                <li><a href="#">Séries</a></li>
                <input type="text" name="pesquisa" id="pesquisa" placeholder="Informe a sua pesquisa...">
            </ul>
        </div>
    </header>
    <div class="container">
        @yield('content')
    </div>
    <footer>
        <span class="span-left">Copyright &copy; 2023 Caio Moizés. Todos os direitos reservados.</span>
        <span class="span-right">Desenvolvido com Laravel.</span>
    </footer>
</body>
</html>
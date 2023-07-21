<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cukamonga Site - Controle</title>
    <link rel="stylesheet" href="/css/style.css">
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="container-login">
        <form class="form-login" method="POST" action="/controle/login">
            @if(session('msg'))
                <span>{{ session('msg') }}</span>
            @endif
            @csrf
            <h1>Login</h1>
            <input type="text" name="login" id="login" placeholder="Informe seu Login">
            <input type="password" name="senha" id="senha" placeholder="Informe sua Senha">
            <input type="submit" value="Entrar">
            <span>Esqueceu sua senha? <a href="#">Clique aqui</a></span>
        </form>
    </div>
</body>
</html>
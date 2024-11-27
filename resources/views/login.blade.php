<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <h1>Faça seu login para continuar</h1>
    @if(session('successMsg'))
            <p style="color: green">{{ session('successMsg') }}</p>
    @endif
    <form action="{{ route('login.control') }}" method="POST">
        @csrf
        @method('POST')

        <input type="email" name="email" placeholder="email">
        <input type="password" name="senha" placeholder="senha">

        <br>
        @if(session('errorMsg'))
            <p style="color: red">{{ session('errorMsg') }}</p>
        @endif

        <button type="submit">Entrar</button>
    </form>
    <br>
    <a href="{{ route('register') }}">Não possuo cadastro!</a>
</body>
</html>
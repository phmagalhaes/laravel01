<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <h1>Faça seu cadastro para continuar</h1>
    <form action="{{ route('register.control') }}" method="POST">
        @csrf
        @method('POST')

        <input type="text" name="nome" placeholder="nome">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="senha" placeholder="senha">
        <select name="tipo" id="">
            <option value="user">Usuário</option>
            <option value="adm">Administrador</option>
        </select>

        <br>

        @if(session('errorMsg'))
            <p style="color: red">{{ session('errorMsg') }}</p>
        @endif
        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <a href="{{ route('login') }}">Já possuo cadastro!</a>
</body>
</html>
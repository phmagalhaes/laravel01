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
    <h1>Crie um sorteio</h1>
    @if(session('successMsg'))
            <p style="color: green">{{ session('successMsg') }}</p>
    @endif
    <form action="{{ route('sorteios.store') }}" method="POST">
        @csrf
        @method('POST')

        <input type="text" name="titulo" placeholder="titulo">
        <br>
        <input type="text" name="opcoes" placeholder="opcoes">
        <label for="opcoes">Insira as opções separadas por ","  Ex: Arroz,Feijão,Batata,Macarrão</label>

        <br>
        @if(session('errorMsg'))
            <p style="color: red">{{ session('errorMsg') }}</p>
        @endif

        <button type="submit">Criar</button>
    </form>
</body>
</html>
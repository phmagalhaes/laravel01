<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <h1>Todos os sorteios</h1>
    <a href="{{ route('logout') }}">Logout</a>
    <a href="{{ route('sorteios.create') }}">Novo sorteio</a>
    @if(session('successMsg'))
            <p style="color: green">{{ session('successMsg') }}</p>
    @endif
    @if ($sorteios->isEmpty())
        <p>Nenhum sorteio cadastrado</p>
    @else
        @foreach ($sorteios as $sorteio)
            @php
                $user = App\Models\Usuario::where('id', $sorteio->usuario_id)->first();
            @endphp
            <div>
                <p><strong>{{ $sorteio->titulo }}</strong> - {{ $sorteio->data_sorteio }}</p>
                <ul>
                    <li><strong>Opções: </strong>
                        @foreach ($sorteio->opcoes as $opcao)
                            {{ $opcao }} -
                        @endforeach
                    </li>
                    <li><strong>Item sorteado: </strong>{{ $sorteio->sorteado }}</li>
                    <li><strong>Criador: </strong>{{ $user->nome }}</li>
                </ul>
            </div>
            <br>
        @endforeach
    @endif
</body>
</html>
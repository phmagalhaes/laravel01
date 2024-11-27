<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sorteio</title>

    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <h1>Último sorteio</h1>
    <div>
        <p><strong>{{ $sorteio->titulo }}</strong> - {{ $sorteio->data_sorteio }}</p>
        <ul>
            <li><strong>Item sorteado: </strong>{{ $sorteio->sorteado }}</li>
        </ul>
    </div>
    @if(session('errorMsg'))
        <p style="color: red">{{ session('errorMsg') }}</p>
    @endif
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $data['titulo'] }} | MuseoITC</title>

    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    <link rel="stylesheet" href="{{asset('css/styles.css?v='.filemtime('css/styles.css'))}}">
</head>

<body>
<div class="card-div">
    <div class="head-div">
        <img width="200" src="{{ asset('img/logo-tecnm.svg') }}">
        <img width="80" src="{{ asset('img/logo-itc.svg') }}">
    </div>
    <div class="body-div">
        <h1>{{ strtoupper($data['titulo']) }}</h1>
        <div style="background-image: url('{{$data['path']}}')" class="div-img">

        </div>
        <div class="desc-div">
            <div class="descripcion-div">
                {!! $data['descripcion'] !!}
            </div>
        </div>
        <h4>{{ $data['fecha'] }}</h4>
    </div>
</div>
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsivo.css') }}">
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="d-flex flex-column h-100">
        <div id="app-site">
            @include('site._partials.header')

            <home-site-component></home-site-component>

            @include('site._partials.footer')

            <a href="https://web.whatsapp.com/send?phone=555198007554&text=Olá+é+da+Bertotto+Veículos?" id="whatsapp" target="_blank">
                <img src="{{url('/')}}/images/whatsapp-flutuante.png" alt="Whatsapp" width="100%" style="width: 100%;">
            </a>
        </div>
    </body>
</html>

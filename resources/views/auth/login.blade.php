<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Faça login em {{env('APP_NAME')}} para acessar sua conta e gerenciar seus aluguéis ou listar itens de forma eficiente. Aproveite nossa plataforma fácil de usar.">
    <meta name="keywords"
        content="login, acesso, plataforma de aluguel, gerenciar aluguéis, listar itens, login online">
    <meta name="author" content="{{env('APP_NAME')}}">
    <!-- Open Graph (para compartilhamento em redes sociais) -->
    <meta property="og:title" content="Login em {{env('APP_NAME')}}">
    <meta property="og:description"
        content="Faça login em {{env('APP_NAME')}} para acessar sua conta e gerenciar seus aluguéis ou listar itens de forma eficiente.">
    <meta property="og:image" content="{{ asset('assets/images/og-image.png') }}">
    <meta property="og:url" content="{{ url('/login') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{env('APP_NAME')}}">
    <!-- Twitter Card (para compartilhamento no Twitter) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Login em {{env('APP_NAME')}}">
    <meta name="twitter:description"
        content="Faça login em {{env('APP_NAME')}} para acessar sua conta e gerenciar seus aluguéis ou listar itens de forma eficiente.">
    <meta name="twitter:image" content="{{ asset('assets/images/twitter-card.png') }}">


    <!-- Link-->
    <link rel="stylesheet" href="{{asset('css/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/navbar/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/filter/filter.css')}}?v={{ time() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/site.webmanifest')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <!-- Scripts-->
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>

    <title>{{env('APP_NAME')}} | Login</title>
</head>


<body>
    <a class="HomePage" href="/">
        <x-application-logo height="50px"></x-application-logo>
    </a>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <x-loginpupup></x-loginpupup>
    <x-notification></x-notification>
</body>
<style>
.fa-x {
    visibility: hidden;
}

.HomePage {
    padding: 5px
}

body {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
    height: 100dvh;
}
</style>


</html>
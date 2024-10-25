<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="google" content="notranslate" />

    <meta name="description"
        content="Alugue produtos perto de você com facilidade em {{ env('APP_NAME') }}. Explore uma ampla variedade de itens, economize tempo e dinheiro, e descubra os melhores produtos disponíveis para locação hoje mesmo.">

    <meta name="keywords"
        content="aluguel de produtos, plataforma de aluguel, categorias de produtos, itens para alugar, aluguel online, encontre produtos">
    <meta name="author" content="{{env('APP_NAME')}}">

    <!-- Open Graph (para compartilhamento em redes sociais) -->
    <meta property="og:title" content="Encontre e Alugue Produtos em {{env('APP_NAME')}}">
    <meta property="og:description"
        content="Explore {{env('APP_NAME')}} para alugar produtos de várias categorias. Descubra ofertas incríveis e comece a alugar de maneira fácil e eficiente.">
    <meta property="og:image" content="https://media.discordapp.net/attachments/1258812250505089064/1280026955072274473/asd.png?ex=66d6957f&is=66d543ff&hm=bfee03117d5469f97901b31b153540ea3f2a65dad79203ea48360a77ff936241&=&format=webp&quality=lossless">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{env('APP_NAME')}}">

    <!-- Twitter Card (para compartilhamento no Twitter) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Encontre e Alugue Produtos em {{env('APP_NAME')}}">
    <meta name="twitter:description"
        content="Explore {{env('APP_NAME')}} para alugar produtos em várias categorias. Encontre os melhores itens e comece a alugar com facilidade.">
    <meta name="twitter:image" content="https://media.discordapp.net/attachments/1258812250505089064/1280026955072274473/asd.png?ex=66d6957f&is=66d543ff&hm=bfee03117d5469f97901b31b153540ea3f2a65dad79203ea48360a77ff936241&=&format=webp&quality=lossless">

    <!-- Link-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/site.webmanifest')}}">

    <link href="https://api.fontshare.com/v2/css?f[]=chillax@400,500,600,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/navbar/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/filter/filter.css')}}?v={{ time() }}">
    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>

    <title>Aluguel Online perto de você | {{ config('app.name') }}</title>

</head>

<body>
    <x-navbar :search="true"></x-navbar>
    @include('layouts.horizontal-category')

    <div id="filter_container">
        <div id="App">
            <x-ItemCard></x-ItemCard>
        </div>
    </div>

    <footer id="politics">
        <div class="siding">
            <p>© 2024 {{env('APP_NAME')}}, LLC.</p>
            <a href="/politicas-privacidade">
                <span>Politicas</span>
            </a>
            <a href="/politicas-privacidade">
                <span>Termos</span>
            </a>
            <a href="/help">
                <span>Ajuda</span>
            </a>
        </div>
        <div class="siding">
            <img loading="lazy" src="{{asset('assets/logo/Icon-Primary.png')}}?v={{time()}}" height="30px" alt="">
        </div>
    </footer>

    <x-notification></x-notification>

</body>

<script src="{{asset('js/index.js')}}?v={{ time() }}"></script>
<script src="{{asset('js/geoposition.js')}}?v={{ time() }}"></script>

</html>

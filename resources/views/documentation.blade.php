<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="google" content="notranslate" />
    <meta name="google-adsense-account" content="ca-pub-4207338093772179">

    <meta name="description"
        content="Encontre e alugue uma ampla variedade de produtos em {{env('APP_NAME')}}. Explore categorias, descubra os melhores itens e comece a alugar de forma simples e rápida.">
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
    <link rel="stylesheet" href="{{asset('css/reservas/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/design/index.css')}}?v={{ time() }}">
    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/notifyError.js')}}?v={{ time() }}"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4207338093772179"
        crossorigin="anonymous"></script>

    <title>Diretrizes de Desgin | Lugator para Designers</title>
</head>

<body>

    <nav>
        <x-application-logo style="height:30px;"></x-application-logo>
        <h2>Documentação</h2>
    </nav>
    <section>
        <h1>Diretrizes de design</h1>
        <h2>Introdução</h2>
        <p>Bem-vindo ao nosso hub para diretrizes e ativos de parceiros. Queremos facilitar para você a integração do
            Spotify em sua plataforma, respeitando nossa marca e restrições legais/de licenciamento. Essas diretrizes
            foram desenvolvidas para garantir que todos os usuários do Spotify recebam a mesma experiência de usuário
            agradável - não importa em qual plataforma eles ouçam.</p>
        <br>
        <br>
        <h2>Logotipo e ícone do {{env('APP_NAME')}}</h2>
        <ul>
            <li>O logotipo é a combinação de uma marca nominativa com nosso ícone.</li>
            <li>Nosso ícone é uma versão mais curta do nosso logotipo. Use-o somente se não tiver espaço suficiente para
                o logotipo completo.</li>
        </ul>
        <img loading="lazy" src="#" alt="Detalhamento da marca">
        <p>O uso do logotipo e dos ícones deve estar em conformidade com nossas Diretrizes de logotipo e cores .</p>

    </section>

</body>


</html>

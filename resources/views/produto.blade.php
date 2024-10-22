<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4207338093772179"
        crossorigin="anonymous"></script>
    <meta name="google-adsense-account" content="ca-pub-4207338093772179">
    <!-- Meta-->
    <meta name="google-adsense-account" content="ca-pub-4207338093772179">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4207338093772179"
        crossorigin="anonymous"></script>

    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta id="item-meta" item-id="{{$item->id}}" content="Identificação do produto">
    <meta id="item-price" item-price="{{$item->price}}" content="Preço do anúncio">
    <meta id="user-owner" user-owner="{{$item->owner}}" content="Usuário que anunciou">
    <meta id="user-loged" user-id="{{Auth::id()}}" content="Identificação do usuario logada">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="google" content="notranslate" />

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="google" content="notranslate" />

    <meta name="description"
        content="Veja {{$item->name_item}} no {{config('app.name')}} e compare com diversos outros produtos.">

    <meta name="keywords"
        content="aluguel de produtos, plataforma de aluguel, categorias de produtos, itens para alugar, aluguel online, encontre produtos">
    <meta name="author" content="{{env('APP_NAME')}}">

    <!-- Open Graph (para compartilhamento em redes sociais) -->
    <meta property="og:title" content="Encontre {{$item->name_item}} perto de você!">
    <meta property="og:description"
        content="Explore {{env('APP_NAME')}} para alugar produtos de várias categorias. Descubra ofertas incríveis e comece a alugar de maneira fácil e eficiente.">
    <meta property="og:image" content="https://media.discordapp.net/attachments/1258812250505089064/1280026955072274473/asd.png?ex=66d6957f&is=66d543ff&hm=bfee03117d5469f97901b31b153540ea3f2a65dad79203ea48360a77ff936241&=&format=webp&quality=lossless">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{env('APP_NAME')}}">

    <!-- Twitter Card (para compartilhamento no Twitter) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Encontre {{$item->name_item}} perto de você!">
    <meta name="twitter:description"
        content="Explore {{env('APP_NAME')}} para alugar produtos em várias categorias. Encontre os melhores itens e comece a alugar com facilidade.">
    <meta name="twitter:image" content="https://media.discordapp.net/attachments/1258812250505089064/1280026955072274473/asd.png?ex=66d6957f&is=66d543ff&hm=bfee03117d5469f97901b31b153540ea3f2a65dad79203ea48360a77ff936241&=&format=webp&quality=lossless">


    <!--Link -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/site.webmanifest')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{asset('css/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/page/index.css')}}?v={{ time() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link href="https://api.fontshare.com/v2/css?f[]=chillax@400,500,600,700&display=swap" rel="stylesheet">
    <!--Scripts -->
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'>
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </script>

    <title>{{$item->name_item}} de {{$item->users->name}} | {{config('app.name')}}</title>

</head>

<body>

    <x-navbar :search="false"></x-navbar>
    <section id="page-container">
        <x-page-profile :item="$item" :links="$imageLinks" :date="$createdAgo"></x-page-profile>
    </section>
    <x-notification></x-notification>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{asset('js/index.js')}}?v={{ time() }}"></script>

    <script src="{{asset('js/flickti.js')}}?v={{ time() }}"></script>
    <script src="{{asset('js/order.js')}}?v={{ time() }}"></script>
    <script src="{{asset('js/datepicket.js')}}?v={{ time() }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="{{asset('css/misc/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/flatpicks.css')}}?v={{ time() }}">


</body>

</html>

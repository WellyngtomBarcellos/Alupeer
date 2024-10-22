<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Encontre respostas para suas perguntas frequentes e obtenha suporte detalhado para usar a plataforma de aluguéis {{config('app.name')}}.
        Navegue por nossos tutoriais e dicas úteis.">



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
    <link rel="stylesheet" href="{{asset('css/helper/index.css')}}?v={{ time() }}">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>



    <title>{{config('app.name')}} Centro de ajuda</title>
</head>


<body>

    <x-navbar :search="false"></x-navbar>
    <iframe src="https://lugator.tawk.help/" frameborder="0"></iframe>

</body>


</html>
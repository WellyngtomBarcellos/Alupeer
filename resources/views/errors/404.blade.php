<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/404/index.css')}}">


    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+MX:wght@100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <script src="{{asset('js/notifyError.js')}}?v={{ time() }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>404 Não encontrado - {{env('APP_NAME')}}</title>
    <style>

    </style>
</head>
<body>
<nav>
    <a href="/">
        <img src="{{asset('assets/logo/icon_second.png')}}" height="50px" alt="">
    </a>
</nav>

<div id="container">
    <aside>
        <h1>Eeeita!</h1>
        <h3>Não conseguimos encontrar a página que você está procurando.</h3>
        <ul>
            <li><a href="/"><p>voltar</p></a></li>
        </ul>
    </aside>

    <aside>
        <img src="{{asset('assets/png/404.png')}}" alt="">
        <p><b>Código de erro: 404</b></p>
    </aside>
</div>

</body>
</html>

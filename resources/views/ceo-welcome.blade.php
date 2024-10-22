<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/welcomelocador.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}?v={{ time() }}">

    <title>Boas vindas à comunidade de locadores do {{env('APP_NAME')}}</title>
</head>

<body>
    <section>
        <div class="image">
            <img loading="lazy" class="scale-in-center" src="{{asset('assets/png/CEO.png')}}" alt="">
        </div>

        <div class="signature ">
            <div class="top-mid slide-in-blurred-right">
                <h1 class="">Tudo pronto, {{Auth::user()->name}}!</h1>
                <p>Bem-vindo à nossa comunidade de locadores! Agradecemos por se juntar a nós e esperamos que sua
                    experiência de aluguel seja enriquecedora e colaborativa. Estamos aqui para apoiar sua jornada!</p>
                <img loading="lazy" class="puff-in-center" src="{{asset('assets/png/signature.png')}}" alt="">
                <p class="item">Wellyngtom Barcellos, CEO</p>
            </div>
        </div>
        <div class="bottom mobile scale-in-center">
            <a href="/user/{{Auth::id()}}">
                <span>Vamos começar</span>
            </a>
        </div>
    </section>
</body>




</html>

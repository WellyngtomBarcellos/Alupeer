<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4207338093772179"
        crossorigin="anonymous"></script>
    <meta name="google-adsense-account" content="ca-pub-4207338093772179">
    <!-- Meta-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="google" content="notranslate" />
    <meta name="google-adsense-account" content="ca-pub-4207338093772179">

    <meta name="cart" content='@json($carrinho)'>



    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="description"
        content="Alugue produtos perto de você com facilidade no {{ env('APP_NAME') }}. Explore uma ampla variedade de itens, economize tempo e dinheiro, e descubra os melhores produtos disponíveis para locação hoje mesmo.">

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
    <link rel="stylesheet" href="{{asset('css/misc/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/filter/filter.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/cart/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="https://unpkg.com/@vectopus/atlas-icons/style.css">
    <link href="https://api.fontshare.com/v2/css?f[]=chillax@400,500,600,700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="{{asset('js/notifyError.js')}}?v={{ time() }}"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4207338093772179"
        crossorigin="anonymous"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>

    <title>Carrinho | {{ config('app.name') }}</title>

</head>

<body>
    <x-navbar :search="false"></x-navbar>

    <h1 class="i">Seu carrinho</h1>
    <section id="Main_cart">


        <div class="cart">
            @if (isset($itemsData))
            @foreach ($itemsData as $itemData)
            <div class="item_container">

                <div class="container_mainer">
                    <a href="/produto/{{$itemData['item']->id}}">
                        <div class="images_container">
                            @if (count($itemData['images']) > 0)
                            <img src="{{ $itemData['images'][0]->link }}" alt="Image" style="max-width: 100px;">
                            @endif
                        </div>
                    </a>

                    <div class="conteudo">
                        <p><strong>{{ $itemData['item']->name_item }}</strong> ({{$itemData['item']->float}})</p>
                        <a href="/user/{{ $itemData['users']->id }}">
                            <p>{{ $itemData['users']->name}}</p>
                        </a>
                        <br>
                        <p>reservado para <strong>{{ count($itemData['specialDates']) }}</strong> dias</p>


                    </div>
                </div>

                <div class="options_container" data-id="{{$itemData['item']->id}}">
                    <i class="at-trash"></i>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        <div class="cart_info">
            <div class="container-inf">
                <h2>Checkout</h2>

                <div class="iten">

                    @foreach ($itemsData as $data )
                    <div class="informate" data-id="{{$data['item']->id}}">
                        <span><strong>{{$data['item']->name_item}}:</strong></span>
                        <span>
                            <strong>R$</strong><strong
                                class="total_price">{{ number_format(count($data['specialDates']) * $data['item']->price, 2, ',', '.') }}</strong>
                        </span>
                    </div>
                    @endforeach


                </div>
                <hr>
                <div class="totalPrice">
                    <span>Total:</span>
                    <span>R$ <strong class="formate_price">{{ number_format($totalValue, 2, ',', '.') }}</strong></span>
                </div>
                @if (session('cart') && count(session('cart')) > 0)
                <hr>
                <span class="disclaimer">*Você não será cobrado agora</span>

                <div class="buttom buttom_reserve">
                    Confirmar reserva
                </div>
                @endif


            </div>
        </div>

    </section>

    <x-footer :top="true"></x-footer>

    <script src="{{asset('js/cart.js')}}"></script>
</body>

</html>

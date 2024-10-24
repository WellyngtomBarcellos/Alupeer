<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="author" content="{{env('APP_NAME')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
    <link rel="stylesheet" href="{{asset('css/navbar/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="https://unpkg.com/@vectopus/atlas-icons/style.css">
    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>
    
    <title>Veja todas as Reservas</title>
</head>

<body>
    <x-navbar :search="false"></x-navbar>


    <div id="popup_informations"></div>

    <div id="Main_reservas">
        <div class="home">
            <div class="cont">
                <h1>Olá, <strong>{{Auth::user()->name}}!</strong></h1>
            </div>
        </div>


        <ul class="list_nav">
            <li class="Active rents_btn"><span>Aluguéis ({{$yourBooks->count()}})</span></li>
            <li class="anounce_btn"><span>Anúncios ({{$dates->count()}})</span></li>
        </ul>


        <div class="chats">

            @if ($reservations->count())
            <div class="messages cata">
                <h1>Notificações</h1>

                <div class="conversasW">

                    @foreach ($reservations as $reserva)
                    @if ($reserva->seen == 0)
                    <a href="/chatify/{{$reserva->user->id}}?product={{ $reserva->item}}">
                        <div class="chatReturn">
                            <div class="sider">
                                <x-user-profile style="height: 40px;width:40px;" :link="$reserva->user->avatar"
                                    :ratestatus="false" :stats="true"></x-user-profile>
                                <div class="ico">
                                    <p>{{ $reserva->user->name }}</p>
                                    <p>{{ $reserva->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <span>Aguardando</span>
                        </div>
                    </a>
                    <hr>
                    @endif
                    @endforeach
                </div>

            </div>

            <div class="inRent cata">
                <h1>Atendimentos</h1>

                <div class="conversasR">
                    @foreach ($reservations as $reserva)

                    @if ($reserva->seen == 1)
                    <a href="/chatify/{{$reserva->user->id}}?product={{ $reserva->item}}">
                        <div class="chatReturn">
                            <div class="sider">
                                <x-user-profile style="height: 40px;width:40px;" :link="$reserva->user->avatar"
                                    :ratestatus="false" :stats="true"></x-user-profile>
                                <div class="ico">
                                    <p>{{ $reserva->user->name }}</p>
                                    <p>{{ $reserva->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif

        </div>



        <div class="reservation_list">

            <div class="lista your_anounce">
                <h1>Aluguéis</h1>

                <div class="container_reservas">
                    @if(isset($yourBooks) && $yourBooks->count())
                    @foreach ($yourBooks as $books)

                    <div class="books" data-div="{{$books->id}}">


                        <div class="header-anounce">
                            <div class="header-header">
                                <div class="ififi">
                                    <x-user-profile style="width: 35px; height:35px" :stats="true" :ratestatus="false"
                                        :link="$books->user_owner->avatar">
                                    </x-user-profile>
                                    <div class="trasaction">
                                        <p>{{$books->user_owner->name}}</p>
                                        @if($books->reservado === 1)
                                        <span class="status waiten">Aguardando</span>
                                        @elseif($books->reservado === 5)
                                        <span class="status success">Completo</span>
                                        @elseif($books->reservado === 4)
                                        <span class="status cancel">Cancelado</span>
                                        @else
                                        <span class="status confirmed">Confirmado</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="chat_div ">
                                <a href="/chatify/{{$books->user_owner->id}}?product={{$books->item->id}}">
                                    @if($books->reservado >= 2 && $books->reservado < 4) <span><i
                                            class="at-chats-lines jello-horizontal"></i> Chat </span>
                                        @endif
                                </a>
                            </div>
                        </div>


                        <div class="container_product">


                            <div class="container_mai">


                                <div class="container_datails">

                                    <div class="informe">
                                        <span>PREÇO</span>
                                        <p>R${{$books->item->price}}</p>
                                    </div>

                                    <div class="informe">
                                        <span>DATA DO PEDIDO</span>
                                        <p>{{ $books->created_at_formatted }}</p>
                                    </div>

                                    <div class="informe">
                                        <span>ITEM</span>
                                        <p>{{$books->item->name_item}}</p>
                                    </div>

                                    <div class="informe">
                                        <span>ITEM</span>
                                        @if($books->item->images->isNotEmpty())
                                        <x-user-profile style="width: 50px; height:50px" :stats="true"
                                            :ratestatus="false" :link="$books->item->images->first()->link">
                                        </x-user-profile>
                                        @endif
                                    </div>
                                </div>







                            </div>



                            <div class="container_mai">
                                <div class="button_detail myOrders" data-id="{{$books->id}}">
                                    Ver pedido <i class="at-orientation-right"></i>
                                </div>
                            </div>

                        </div>

                    </div>

                    @endforeach
                    @else
                    <div class="noOne">
                        <i class="fa-solid fa-list-check"></i>
                        <p>Nenhuma reserva encontrada.</p>
                    </div>
                    @endif
                </div>


            </div>

            <div class="lista your_booking">
                <h1>Anúncios</h1>

                <div class="container_reservas">
                    @if(isset($dates) && $dates->count())
                    @foreach ($dates as $pedidos )

                    <div class="books" data-div="{{$pedidos->id}}">
                        <div class="header-anounce">
                            <div class="header-header">
                                <div class="ififi">
                                    <x-user-profile style="width: 35px; height:35px" :stats="true" :ratestatus="false"
                                        :link="$pedidos->user->avatar">
                                    </x-user-profile>
                                    <div class="trasaction">
                                        <p>{{$pedidos->user->name}}</p>
                                        @if($pedidos->reservado === 1)
                                        <span class="status waiten">Aguardando</span>
                                        @elseif($pedidos->reservado === 5)
                                        <span class="status success">Completo</span>
                                        @elseif($pedidos->reservado === 4)
                                        <span class="status cancel">Cancelado</span>
                                        @else
                                        <span class="status confirmed">Confirmado</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="chat_div ">
                                <a href="/chatify/{{$pedidos->user_id}}?product={{$pedidos->item->id}}">
                                    @if($pedidos->reservado >= 1 && $pedidos->reservado < 4) <span><i
                                            class="at-chats-lines jello-horizontal"></i> Chat </span>
                                        @endif
                                </a>
                            </div>
                        </div>


                        <div class="container_product">


                            <div class="container_mai">
                                <div class="container_datails">

                                    <div class="informe">
                                        <span>PREÇO</span>
                                        <p>R${{$pedidos->item->price}}</p>
                                    </div>

                                    <div class="informe">
                                        <span>DATA DO PEDIDO</span>
                                        <p>{{ $pedidos->created_at_formatted }}</p>
                                    </div>

                                    <div class="informe">
                                        <span>ITEM</span>
                                        <p>{{$pedidos->item->name_item}}</p>
                                    </div>

                                    <div class="informe">
                                        <span>ITEM</span>
                                        @if($pedidos->item->images->isNotEmpty())
                                        <x-user-profile style="width: 50px; height:50px" :stats="true"
                                            :ratestatus="false" :link="$pedidos->item->images->first()->link">
                                        </x-user-profile>
                                        @endif
                                    </div>

                                </div>
                            </div>



                            <div class="container_mai">
                                <div class="button_detail myBooking" data-id="{{$pedidos->id}}">
                                    Ver pedido <i class="at-orientation-right"></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    @endforeach
                    @else
                    <div class="noOne">
                        <i class="fa-solid fa-list-check"></i>
                        <p>Nenhuma reserva encontrada.</p>
                    </div>
                    @endif
                </div>

            </div>

        </div>

        </section>


        <x-notification></x-notification>
</body>

<script src="{{asset('js/index.js')}}?v={{ time() }}"></script>
<script src="{{asset('js/booking.js')}}?v={{ time() }}"></script>





</html>

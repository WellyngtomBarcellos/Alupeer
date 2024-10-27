<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/navbar/index.css') }}?v={{ time() }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="cart_count" content="{{ json_encode(session('cart', [])) }}">


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{asset('js/index.js')}}?v={{ time() }}"></script>
<script src="{{asset('js/loader.js')}}?v={{ time() }}"></script>
<script src="{{asset('js/warning.js')}}?v={{ time() }}"></script>

<x-top-loader></x-top-loader>

<div id="Login">
    <x-loginpupup></x-loginpupup>
</div>

<nav id="navbar_container">
    <div class="side">
        <a class="homeHouse" href="{{route('home')}}">
            <x-application-logo style="height:30px"></x-application-logo>
        </a>
    </div>

    @if ($search)
    <div class="center search_bar-defautl">
        <ion-icon name="search-outline" class="search_icon"></ion-icon>
        <input type="text" id="search_input" placeholder="oquê procura ?" autocomplete="off">
        <i class="fa-solid fa-sliders filter_btn"></i>
        
    </div>
    @endif

    @auth

    <div class="side">

        <a class="Cart_div" href="{{route('carrinho')}}">
            @if (session('cart') && count(session('cart')) > 0)
            <span class="show_cart">
                <p class="cart_num">{{ count(session('cart', [])) }}</p>
            </span>
            @endif
            <ion-icon name="cart-outline"></ion-icon>
        </a>

        <a class="chat_btn chat_mobile" href="{{route('anouce.before')}}">
            <span>Vou anunciar</span>
        </a>

        <span class='snumber_notify mobline_notiifi'></span>

        <div class="menu-profile profile-btn">
            <ion-icon name="menu"></ion-icon>
            <x-loged-User-picture style="width:35px;height:35px">
            </x-loged-User-picture>
        </div>

        <div id="Option">
            <li><a href="/user/{{Auth::user()->id}}">
                    <ion-icon name="flame"></ion-icon>Meus anúncios
                </a>
            </li>

            <li>
                <a href="/locador">
                    <ion-icon name="extension-puzzle"></ion-icon>
                    Anunciar
                </a>
            </li>

            <li class="chat_mobile_li">
                <a href="{{route('reservations')}}">
                    <span class='snumber_notify mobline_notiifi'></span>
                    <ion-icon name="chatbox-ellipses"></ion-icon>
                    Reservas
                </a>
            </li>

            <li>
                <a href="{{route('profile.edit')}}">
                    <ion-icon name="cog"></ion-icon>
                    Configurações
                </a>
            </li>

            <li><a href="/help">
                    <ion-icon name="information-circle"></ion-icon> Ajuda
                </a>
            </li>


            <li class="click-to-logout"><a>
                    <ion-icon class="exit" name="exit"></ion-icon> Sair
                </a>
            </li>

        </div>
        
    </div>

    @else

    <span class="side loginSide lbtn">
        <span>Entrar/Registrar</span>
        <div class="picture_profile">
            <ion-icon name="person"></ion-icon>
        </div>
    </span>

    @endauth
</nav>



@if ($search)
<div class="side search_barA">
    <div class="center search_bar">
        <ion-icon name="search-outline"></ion-icon>
        <input type="text" id="search_input_mobile" name="" placeholder="Oquê Está procurando" autocomplete="off">
        <i class="fa-solid fa-sliders filter_btn"></i>
    </div>
</div>
@endif







<script>
$(document).ready(function() {
    $('.profile-btn').on('click', function() {
        event.stopPropagation();
        var option = $('#Option');
        option.css('display', option.css('display') === 'flex' ? 'none' : 'flex');
    });
    $('.click-to-logout').on('click', function() {

        $.ajax({
            url: "{{route('logout')}}",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            dataType: 'json',
            complete: function() {
                location.reload()
            }
        });
    });

    $('.lbtn').on('click', function() {
        $('body').css('overflow', 'hidden')
        var container_login = $('#Login')
        $.ajax({
            url: "{{route('login.popup')}}",
            type: 'GET',
            success: function(response) {
                container_login.css('display', 'flex')
                container_login.html(response)
            }
        });
    });
})
</script>

@auth
<script src="{{asset('js/stats.js')}}?v={{ time() }}"></script>
<script src="{{asset('js/notification.js')}}?v={{ time() }}"></script>
@endauth

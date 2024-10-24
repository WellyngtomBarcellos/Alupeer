@php
$auth = Auth::id()
@endphp
@include('Chatify::layouts.headLinks')

<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
    integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<x-navbar :search="false"></x-navbar>

<div class="header_links">
    <a href="/">Inicio</a>
    >
    <a href="/reservas">Reservas</a>
    >
    <a href="#">Mensagens</a>
    >
    <p id="name_itemHeader"></p>
</div>

<section class="contaner_messages">
    <div class="messenger">
        {{-- ----------------------Users/Groups lists side---------------------- --}}
        <div style="display: none;" class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
            <div class="m-body contacts-container">
                <div class="show messenger-tab users-tab app-scroll" data-view="users">
                    <div class="favorites-section">
                        <div class="messenger-favorites app-scroll-hidden"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ----------------------Messaging side---------------------- --}}
        <div class="messenger-messagingView">
            {{-- header title [conversation name] amd buttons --}}
            <div class="m-header m-header-messaging">
                <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    {{-- header back button, avatar and user name --}}
                    <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                        <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>

                        <div class="avatar av-s header-avatar"
                            style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                        </div>

                        <a href="#" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;"
                            class="user-name">{{ config('chatify.name') }}</a>
                    </div>
                    {{-- header buttons --}}
                    <nav class="m-header-right">

                        <a href="/">Voltar</a>
                        {{--<a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>--}}
                    </nav>
                </nav>
                {{-- Internet connection --}}
                <div class="internet-connection">
                    <span class="ic-connected">Online</span>
                    <span class="ic-connecting">Conectando</span>
                    <span class="ic-noInternet">Sem conexão</span>
                </div>
            </div>

            {{-- Messaging area --}}
            <div class="m-body messages-container app-scroll">
                <div class="messages">
                    <p class="message-hint center-el"></p>
                </div>
                {{-- Typing indicator --}}
                <div class="typing-indicator">
                    <div class="message-card typing">
                        <div class="message">

                            <span class="typing-dots">
                                <span class="dot dot-1"></span>
                                <span class="dot dot-2"></span>
                                <span class="dot dot-3"></span>
                            </span>

                        </div>
                    </div>
                </div>

            </div>
            {{-- Send Message Form --}}
            @include('Chatify::layouts.sendForm')
        </div>
        {{-- ---------------------- Info side ---------------------- --}}

        <div class="messenger-infoView app-scroll" style="display:none">
            {{-- nav actions --}}
            <nav>
                <p>Detalhes</p>
                <a href="#"><i class="fas fa-times"></i></a>
            </nav>
            {!! view('Chatify::layouts.info')->render() !!}
        </div>

    </div>

    <div class="produt_contat">
        <div class="container_pro">
            <h1 id="name_item"></h1>
            <p style="display: none;" id="loged_id">
                @json((int)$auth)
            </p>
            <div class="image_loade">
                <img loading="lazy" id="load_image" src="" alt="">
            </div>
            <div class="pri">
                <span id="pricing_loade"></span>
                <p>/dia</p>
            </div>

            <div class="info_total">

            </div>
        </div>
        <div class="details">
            <span></span>
        </div>
    </div>

</section>

@include('Chatify::layouts.modals')
<x-footer :top="true"></x-footer>


@include('Chatify::layouts.footerLinks')

<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>
<script src="{{asset('js/order.js')}}?v={{ time() }}"></script>
<script src="{{asset('js/datepicket.js')}}?v={{ time() }}"></script>

<link rel="stylesheet" href="{{asset('css/index.css')}}?v={{ time() }}">
<link rel="stylesheet" href="{{asset('css/navbar/index.css')}}?v={{ time() }}">
<link rel="stylesheet" href="{{asset('css/misc/index.css')}}?v={{ time() }}">

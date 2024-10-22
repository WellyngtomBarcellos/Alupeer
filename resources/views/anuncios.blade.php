<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta name="google-adsense-account" content="ca-pub-4207338093772179">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4207338093772179"
        crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Script -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'>
    </script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
    <link href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css'
        rel='stylesheet' />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/listing/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/anouce/index.css')}}?v={{ time() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/site.webmanifest')}}">

    <title>{{$user->name}} | Explore o perfil</title>

</head>

<body>
    <x-navbar :search="false"></x-navbar>

    <section id="popup"></section>

    <section id="side_by_side">

        <div class="container_listing">
            <div class="conta">

                <div class="profi pro">
                    <x-user-profile :stats="true" :ratestatus="true" :rate="$rating" :link="$user->avatar"
                        style="width:130px;height:130px;">
                    </x-user-profile>


                    <p class="name">{{$user->name}}</p>
                    <div class="reviews">
                        <span>{{$user->created_at->diffForHumans()}} no {{env('APP_NAME')}}</span>
                    </div>
                </div>

                <div class="ratings">
                    <div class="reviews" data-rate="{{$rating}}">
                        <span id="rating-stars"></span>
                        <i>Avaliações de <strong>{{$reviews}}</strong> usuários</i>
                    </div>

                </div>

            </div>




        </div>


        <div class="asi">
            <aside>
                <div class="reviews" data-rate="{{$rating}}">
                    <span id="rating-stars"></span>
                    <i>Avaliações de <strong>{{$reviews}}</strong> usuários</i>
                </div>
            </aside>
        </div>

        <div class="container">

            <div class="Container-Anounce">
                <div class="header">
                    <h2>Anúncios</h2>
                </div>


                <div class="Shopp">
                    @foreach ($items->take(2) as $item)
                    @if ($item->images->isNotEmpty())
                    <x-anuncio_profile :item="$item"></x-anuncio_profile>
                    @endif
                    @endforeach
                </div>

                <div class="listing">
                    <div class="header_">
                        <i class="fa-solid fa-x close_listing"></i>
                        <h1>Todos os anuncios</h1>
                        <a href=""></a>
                    </div>
                    <div class="container_lister">
                        @foreach ($items as $item)
                        @if ($item->images->isNotEmpty())
                        <x-anuncio_profile :item="$item"></x-anuncio_profile>
                        @endif
                        @endforeach
                    </div>
                </div>

                @if (count($items) > 2)
                <span class="more_anounce">Ver mais</span>
                @endif
            </div>





        </div>

    </section>

    <section>
        <div class="profile_user"></div>
    </section>

    <x-footer :top="true"></x-footer>
    <x-notification></x-notification>



    <script src="{{asset('js/index.js')}}?v={{ time() }}"></script>
    <script>
    $(document).ready(function() {
        var id = "{{ $user->id }}";

        function online() {
            $.ajax({
                url: '/update-activity/status',
                type: 'POST',
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var status = $('#status_login')
                    status.css('display', response ? 'flex' : 'none');
                },
            });
        }

        setInterval(online, 10000);
        $(window).on('beforeunload', function() {
            online();
        });

        online();







        function renderStars(container, rating) {
            const fullStars = Math.floor(rating);
            const halfStar = rating % 1 >= 0.5;
            const emptyStars = 5 - Math.ceil(rating);

            container.empty(); // Limpa o conteúdo do container

            // Adicionar estrelas cheias
            for (let i = 0; i < fullStars; i++) {
                container.append('<i class="fas fa-star"></i>');
            }

            // Adicionar meia estrela se necessário
            if (halfStar) {
                container.append('<i class="fas fa-star-half-alt"></i>');
            }

            // Adicionar estrelas vazias
            for (let i = 0; i < emptyStars; i++) {
                container.append('<i class="far fa-star"></i>');
            }
        }

        // Pega o valor do atributo data-rate
        $('.reviews').each(function() {
            const rating = parseFloat($(this).data('rate'));
            const starsContainer = $(this).find('#rating-stars');
            renderStars(starsContainer, rating);
        });









    });
    </script>
</body>






</html>

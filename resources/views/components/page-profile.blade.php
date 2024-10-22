<div id="Section">
    <div class="main_page">
        <div class="images">

            <div id="Container_Image_Products">
                @if (isset($links))
                <div class="main-carousel">
                    @foreach ($links as $link)
                    <div class="carousel-cell">
                        <div class="blur-background" style="background-image: url('{{ $link }}');"></div>
                        <img loading="lazy" src="{{$link}}" alt="" class="foreground-image">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="container-detais">
                <h1>{{$item->name_item}}</h1>
                <p>{{$item->descricao}}</p>
                <p>Desgaste: <strong>{{$item->float}}</strong>
                </p>
            </div>

            <div class="container">
                <!-- SESSÃO PRINCIPAL-->
                <div class="review">
                    <x-classification :rate="$item->classification"></x-classification>
                    @if (count($item->reviews) >0)
                    <div class="card_review">
                        <div class="wrapper">
                            @foreach ($item->reviews as $review)
                            <div class="card">
                                <div class="profile">
                                    <x-user-profile :stats="false" :ratestatus="false" :rate="0"
                                        style="width: 50px; height:50px;" :link='$review->user->avatar'>
                                    </x-user-profile>
                                    <div class="status">
                                        <p>{{$review->user->name}}</p>
                                        <div class="star">
                                            @foreach (range(1, $review->star) as $star)
                                            <i class="fa-solid fa-star rate_star"></i>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="coment">
                                    <p>{{$review->content}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if (count($item->reviews) > 1)
                        <button class="scroll-button prev"><i class="fa-solid fa-chevron-left"></i></button>
                        <button class="scroll-button next"><i class="fa-solid fa-chevron-right"></i></button>
                        @endif

                    </div>
                    @endif






                </div>
                <!-- FIM DA SESSÃO PRINCIPAL-->
                <hr>
                <!-- SESSÃO DO LOCADOR-->
                <div class="review meet_loquer">
                    <div class="rate">
                        <h1>Conheça {{$item->users->name}}</h1>
                    </div>
                    <a href="{{ route('Mylisting', ['user' => $item->users->id]) }}" class="meet">
                        <div class="profile_left">

                            <x-user-profile :stats="true" :rate="0" :ratestatus="true"
                                style="width: 100px; height:100px;" :link="$item->users->avatar">
                            </x-user-profile>

                            <p class="username">{{$item->users->name}}</p>

                            <script>

                            </script>

                        </div>
                    </a>
                </div>
                <!-- FIM SESSÃO DO LOCADOR-->

                <!-- SESSÃO DE COMENTÁRIOS-->
                <div class="coments">

                    @auth
                    @if ($item->users->id != Auth::id())
                    <div class="header">
                        <h1>Pergunte ao Locador</h1>
                        <p>Tire suas dúvidas e pergunte o que quiser a {{$item->users->name}}</p>
                        <p>Breve você terá uma resposta!</p>
                    </div>
                    @endif
                    @else
                    @endauth


                    <div class="maping">

                        <div id="ask">
                            @auth
                            @if ($item->owner !== Auth::id())

                            <div class="text">
                                <textarea placeholder="Qual sua dúvida?" maxlength="120" name="asking"
                                    id="asking"></textarea>
                                <div id="charCount">0/120</div>
                            </div>
                            <span class="askk">Perguntar</span>

                            @else

                            <div class="text">
                                <h2>Veja as principais dúvidas.</h2>
                                <p></p>
                            </div>
                            <p></p>

                            @endif
                            @endauth
                        </div>

                        <h4>Últimas perguntas</h4>
                        <div id="comentarios_section">
                            @foreach($item->questions->take(3) as $question)
                            <div id="comentario_profile">
                                <i class="username">
                                    {{$question->user->name}}
                                    <span>{{ $question->created_at->format('d/m/Y') }}</span>
                                </i>
                                <p>{{$question->content}}</p>

                                @if ($item->owner == Auth::id() && $question->answers->isEmpty())
                                <p data-question="{{$question->id}}" data-user="{{$question->user_id}}"
                                    data-post="{{$item->id}}" class="responder">
                                    responder
                                </p>
                                @endif

                                @if($question->answers->isNotEmpty())
                                @foreach($question->answers as $answer)
                                <span>
                                    {{$answer->content}}
                                    <span>{{ $answer->created_at->format('d/m/Y') }}</span>
                                </span>

                                @endforeach
                                @endif

                                <div class="comeen"></div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
                <!-- FIM DA SESSÃO DE COMENTÁRIOS-->
            </div>
        </div>
        <!-- FLUTTER DE INFORMAÇÕES-->
        <div class="top-flutter">
            <div class="flutter-stick">
                <div class="flutter">

                    <h1>{{$item->name_item}}</h1>
                    <p>*Você não será cobrado pela reserva</p>

                    <span>R$<strong>{{ number_format($item->price, 2, ',', '.') }}</strong>/dia</span>
                    <span>Estado: <b> {{$item->float}}</b></span>

                    @auth
                    @if (Auth::id() != $item->owner)

                    <div class="booking" id="check-out-date">
                        <p>Reservar</p>
                    </div>
                    @else
                    <div class="booking">
                        <p>Seu anúncio</p>
                    </div>
                    @endif
                    @else
                    <div class="booking-off lbtn">
                        <p>Faça login</p>
                    </div>
                    @endauth

                </div>
            </div>
        </div>
        <!-- FIM DO FLUTTER DE INFORMAÇÕES-->
    </div>
</div>

@auth
<div class="flutter_mobile">

    @auth
    @if (Auth::id() != $item->owner)
    <div class="headering" id="check-out-date">
        <p>Reservar</p>
    </div>
    @else
    <div class="headering">
        <p>Seu anúncio</p>
    </div>
    @endif
    @endauth

    <h1 class="namee">{{$item->name_item}}</h1>
    <span>Estado: <b> {{$item->float}}</b></span>
    <span>R$<strong>{{ number_format($item->price, 2, ',', '.') }}</strong>/dia</span>
</div>
@endauth

<div class="info_total"></div>
<x-footer :top="true"></x-footer>


<script>
$(document).ready(function() {
    var $wrapper = $('.wrapper');
    var scrollAmount = 500; // Ajuste conforme necessário

    $('.scroll-button.prev').click(function() {
        $wrapper.animate({
            scrollLeft: $wrapper.scrollLeft() - scrollAmount
        }, 500);
    });


    $('.close_information_mobile').click(function() {
        $('.information_mobile').removeClass('show');
        setTimeout(function() {
            $('.headering').fadeIn(300);
            $('body').removeClass('no-scroll'); // Remove a classe para permitir o scroll
        }, 300); // Tempo igual ao da transição CSS
    });


    $('.scroll-button.next').click(function() {
        $wrapper.animate({

            scrollLeft: $wrapper.scrollLeft() + scrollAmount
        }, 500);
    });

    $('.bookinga').on('click', function() {
        var id = '{{$item->users->id}}';
        var id_ = '{{$item->id}}';
        var appUrl = "{{ env('APP_URL') }}";


        var targetUrl = appUrl + '/chatify/' + id + '?product=' + id_;
        window.location.href = targetUrl;
    });

});
</script>
@auth
<script>
$(document).ready(function() {

    $('#asking').on('input', function() {
        var maxLength = $(this).attr('maxlength');
        var length = $(this).val().length;
        $('#charCount').text(length + '/120');
    });


    $('.askk').on('click', function() {
        var coment = $('#asking').val();
        var section = $('#comentarios_section');
        var userName = "{{ Auth::user()->name }}";
        var token = "{{ $item->token }}";
        var currentTime = "Agora mesmo";
        $.ajax({
            url: "/send-coment/post",
            data: {
                coment: coment,
                token: token
            },
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                section.prepend(`
                            <div id="comentario_profile">
                                    <i class="username">${userName}<span>${currentTime}</span></i>
                                    <p>${coment}</p>
                                </div>
                            `);
                $('#asking').val('');
                $('#charCount').text('0/120');
            },
            error: function(xhr, status, error) {

                console.error(error);
            }
        });
    });
});
</script>
@endauth

<script>
$(document).ready(function() {

    $(document).on('click', '.responder', function() {
        $('.answer_container').not($(this).next('.answer_container')).remove();
        $('.responder').show();

        var $this = $(this);
        var postId = $this.data('post');
        var userId = $this.data('user');
        var questionId = $this.data('question');

        $this.hide().after(`
            <div class="answer_container">
                <textarea placeholder="Diga algo..." class="textarea_answer" id="answer_${postId}"></textarea>
                <span class="responder_btn" data-post="${postId}" data-question="${questionId}" data-user="${userId}">Responder</span>
            </div>
        `);
    });

    $(document).on('click', '.responder_btn', function() {
        var $btn = $(this);
        var $container = $btn.closest('.answer_container');
        var answerContent = $container.find('.textarea_answer').val().trim();

        if (answerContent) {
            $.post("/send-answer/post", {
                    answer: answerContent,
                    user_id: $btn.data('user'),
                    product: $btn.data('post'),
                    question: $btn.data('question'),
                    _token: '{{csrf_token()}}'
                })
                .done(function(response) {
                    if (response.success) {
                        $container.find('.textarea_answer, .responder_btn').hide();
                        var currentDateTime = new Date().toLocaleDateString('pt-BR');
                        var answerPreview = `
                            <i class="fa-solid fa-reply answer"></i>
                            <span>
                                ${answerContent}
                                <span>${currentDateTime}</span>
                            </span>
                        `;
                        $btn.closest('#comentario_profile').find('.comeen').append(answerPreview);
                    } else {
                        alert(response.message);
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error(error);
                });
        }
    });

});

$(document).ready(function() {

    var id = "{{ $item->users->id }}";

    function updateActivity() {
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

    setInterval(updateActivity, 10000);
    $(window).on('beforeunload', function() {
        updateActivity();
    });
    updateActivity();
});
</script>

@include('Chatify::layouts.headLinks')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    /* ------------------------------- Card do produto (negociação) ------------------------------- */
    .deal-item-card {
        display: flex;
        gap: 12px;
        padding: 10px 14px;
        margin: 10px 14px;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.12);
        align-items: flex-start;
        position: relative;
        z-index: 5;
    }

    .deal-item-card .image_loade {
        display: none;
        width: 84px;
        height: 84px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        background: #f4f4f4;
        align-items: center;
        justify-content: center;
    }

    .deal-item-card .image_loade.loaded {
        display: flex;
    }

    .deal-item-card .image_loade img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .deal-item-card .deal-info {
        flex: 1;
        min-width: 0;
    }

    .deal-item-card .deal-title {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 8px;
    }

    .deal-item-card .deal-title h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #121212;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .deal-item-card .deal-price {
        color: #2a8b4a;
        font-size: 15px;
        font-weight: 700;
        white-space: nowrap;
    }

    .deal-item-card .details {
        font-size: 12px;
        color: #6b6b6b;
        max-height: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-top: 2px;
    }

    .deal-item-card .details span {
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .deal-item-card .reserve-status {
        display: inline-block;
        margin-top: 6px;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 999px;
        background: #eee;
        color: #444;
    }

    .deal-item-card .reserve-status[data-status="1"] {
        background: #fff3cd;
        color: #856404;
    }

    .deal-item-card .reserve-status[data-status="2"],
    .deal-item-card .reserve-status[data-status="3"],
    .deal-item-card .reserve-status[data-status="5"] {
        background: #d4edda;
        color: #1c7032;
    }

    .deal-item-card .reserve-status[data-status="4"] {
        background: #f8d7da;
        color: #7a1b1b;
    }

    .deal-actions {
        display: flex;
        gap: 8px;
        margin-top: 8px;
    }

    .deal-actions[hidden] {
        display: none;
    }

    .deal-actions button {
        flex: 1;
        border: none;
        border-radius: 8px;
        padding: 8px 0;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: opacity 0.15s ease;
    }

    .deal-actions button:hover {
        opacity: 0.85;
    }

    .deal-actions button:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .deal-actions .deal-accept {
        background: #23c147;
        color: #fff;
    }

    .deal-actions .deal-reject {
        background: #f04d4d;
        color: #fff;
    }

    /* Bloqueia a lista de outras conversas quando a negociação tem produto */
    .messenger-listView.messenger-listView-locked {
        display: none !important;
    }
</style>
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }} {{ request()->query('product')
                ? 'messenger-listView-locked'
                : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search" />
            {{-- Tabs --}}
            {{-- <div class="messenger-listView-tabs">
                <a href="#" class="active-tab" data-view="users">
                    <span class="far fa-user"></span> Contacts</a>
            </div> --}}
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container">
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favorites --}}
               <div class="favorites-section">
                <p class="messenger-title"><span>Favorites</span></p>
                <div class="messenger-favorites app-scroll-hidden"></div>
               </div>
               {{-- Saved Messages --}}
               <p class="messenger-title"><span>Your Space</span></p>
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
               {{-- Contact --}}
               <p class="messenger-title"><span>All Messages</span></p>
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
           </div>
             {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title"><span>Search</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search..</span></p>
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
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting...</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
        </div>

        @if (request()->query('product'))
        {{-- ----------------------Card do produto [Mercado Livre style]---------------------- --}}
        <div class="deal-item-card" data-status="0">
            <div class="deal-thumb image_loade">
                <img id="load_image" src="" alt="Imagem do produto" loading="lazy">
            </div>
            <div class="deal-info">
                <div class="deal-title">
                    <h3 id="name_item">Produto</h3>
                    <strong id="pricing_loade" class="deal-price">--</strong>
                </div>
                <div class="details">
                    <span></span>
                </div>
                <div class="deal-status-wrap">
                    <span class="reserve-status" id="reserve_status" data-status="0"></span>
                </div>
                <div class="deal-actions" hidden>
                    <input type="hidden" id="reserve_id" value="">
                    <button type="button" class="deal-accept">Aceitar</button>
                    <button type="button" class="deal-reject">Recusar</button>
                </div>
            </div>
        </div>
        @endif

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
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
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
        <nav>
            <p>User Details</p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')

@if (request()->query('product'))
<script>
    (function () {
        var chatterId = (window.location.href.split('chatify/')[1] || '').split('?')[0];
        var params = new URLSearchParams(window.location.search);
        var product = params.get('product');

        if (!chatterId || !product || $('.deal-item-card').length === 0) {
            return;
        }

        // No modo negociação, o botão voltar sai para "Reservas"
        // em vez de abrir a lista de outras conversas
        $('.m-header-messaging .show-listView')
            .off('click')
            .attr('href', '{{ route('reservations') }}');

        var card = $('.deal-item-card');
        var statusBadge = card.find('#reserve_status');
        var actions = card.find('.deal-actions');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var statusLabels = {
            0: '',
            1: 'Reserva aguardando confirmação',
            2: 'Reserva confirmada',
            3: 'Reserva confirmada',
            4: 'Reserva cancelada',
            5: 'Reserva completa'
        };

        function renderStatus(status, iAmOwner) {
            statusBadge.attr('data-status', status);

            if (status === 1 && iAmOwner) {
                statusBadge.text('Aguardando sua resposta');
                card.attr('data-status', status);
                actions.prop('hidden', false);
                return;
            }

            statusBadge.text(statusLabels[status] || '');
            actions.prop('hidden', true);
        }

        // Dados do produto
        $.ajax({
            url: '{{ route('chatData') }}',
            method: 'GET',
            data: { id: chatterId, item: product },
            success: function (response) {
                if (!response || !response.produto) {
                    return;
                }

                card.find('#name_item').text(response.produto.name_item);
                card.find('#pricing_loade').text('R$' + response.produto.price);
                card.find('.details span').text(response.produto.descricao);

                if (response.produto.images.length > 0) {
                    card.find('#load_image').attr('src', response.produto.images[0].link);
                    card.find('.image_loade').addClass('loaded');
                }
            }
        });

        // Status da reserva
        $.ajax({
            url: '{{ route('reserva.between') }}',
            method: 'GET',
            data: { item: product, user: chatterId },
            success: function (response) {
                if (!response || !response.exists) {
                    return;
                }

                card.find('#reserve_id').val(response.id);
                renderStatus(response.status, response.i_am_owner);
            }
        });

        // Aceitar reserva
        actions.find('.deal-accept').on('click', function () {
            var $btn = $(this);
            $btn.prop('disabled', true).text('Confirmando...');

            $.post('{{ route('acceptBooking') }}', {
                item: card.find('#reserve_id').val(),
                _token: csrfToken
            }).done(function (response) {
                if (response.success) {
                    renderStatus(3, true);
                }
            }).fail(function () {
                $btn.prop('disabled', false).text('Aceitar');
            });
        });

        // Recusar reserva
        actions.find('.deal-reject').on('click', function () {
            var $btn = $(this);
            $btn.prop('disabled', true).text('Cancelando...');

            $.post('{{ route('deleteBooking') }}', {
                item: card.find('#reserve_id').val(),
                _token: csrfToken
            }).done(function (response) {
                if (response.success) {
                    renderStatus(4, true);
                }
            }).fail(function () {
                $btn.prop('disabled', false).text('Recusar');
            });
        });
    })();
</script>
@endif

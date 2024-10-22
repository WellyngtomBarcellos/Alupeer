<!-- resources/views/checkout.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Script-->
    <script src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/saldo/index.css')}}?v={{ time() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/site.webmanifest')}}">

    <title>{{ config('app.name') }} | Vamos adicionar seu Saldo</title>
</head>

<body>

    <x-navbar :search="false"></x-navbar>

    <div id="component_popup">
        <ion-icon class="close_wallet" name="close-outline"></ion-icon>

        <x-loader style="display: none"></x-loader>

        <div class="refound">
            <h1>Quanto quer adicionar ?</h1>
            <p>Adicione fundos à sua carteira e aproveite ainda mais nossos serviços. Insira o valor desejado e complete
                a transação de forma rápida e segura com nosso sistema de pagamento.</p>

            <div class="value_payment">
                <span>R$</span>
                <input type="number" id="value" value="10">
            </div>
            <button id="checkout-button">Finalizar</button>
        </div>
    </div>


    <div id="Container_Wallet">
        <div class="container_prices user_status">
            <h3>Seja bem vindo: <br> <span>Wellyngtom</span></h3>

            <x-loged-User-picture style="width:100px;height: 100px ;"></x-loged-User-picture>
        </div>
        <div class="container_prices wallet_status">
            <h3>Sua Carteira possui:</h3>
            <span>R${{Auth::user()->saldo}}</span>
            <p class="wallet_foun">Adicionar saldo</p>
        </div>
    </div>

    <div id="history">
        <h3>Histórico de Aluguéis</h3>
    </div>

    <script>
    $(document).ready(function() {
        var stripe_key = '{{ env("STRIPE_KEY") }}';
        var stripe = Stripe(stripe_key);

        $('#checkout-button').on('click', function() {

            var value = $('#value').val();

            $('#checkout-button').css('display', 'none')
            $('.loader').css('display', 'flex')

            $.ajax({
                url: "{{route('checkout.create')}}",
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: JSON.stringify({
                    amount: value
                }),
                success: function(response) {
                    stripe.redirectToCheckout({
                        sessionId: response.sessionId
                    }).then(function(result) {
                        if (result.error) {
                            alert(result.error.message);
                        }
                    });
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });

        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('.wallet_foun').on('click', function() {
            $('#component_popup').css('display', 'flex')
            setTimeout(() => {
                $('.loader').css('display', 'none')



            }, 2000);
        });
        $('.close_wallet').on('click', function() {
            $('#component_popup').css('display', 'none')
        })
    });
    </script>
</body>

</html>
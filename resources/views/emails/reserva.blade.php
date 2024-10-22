<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva recebida</title>
    <style>
    /* Garantindo que a margem e o padding sejam zerados em todos os elementos */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f4f4;
        color: #212121;
        margin: 0;
        padding: 0;
        width: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }

    .container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
        text-align: center;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }

    .header img {
        width: 100%;
    }

    .content {
        padding: 20px;
        text-align: left;
    }

    .content h1 {
        font-size: 22px;
        color: #ef3c46;
        margin-bottom: 10px;
    }

    .content p {
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .informes {
        text-align: center;
        margin-bottom: 15px;
        padding: 10px;
    }

    .informes img {
        width: 30px;
        height: 30px;
        margin-right: 10px;
    }

    .informes h3 {
        font-size: 18px;
        margin: 0;
        margin-right: 10px;
    }

    .informesa ul {
        list-style-type: none;
        text-align: center;
    }

    .informesa ul li {
        font-size: 16px;
    }

    .button {
        text-align: center;
        margin: 20px 0;
    }

    .button a {
        text-decoration: none;
        padding: 10px 20px;
        background-color: #ef3c46;
        color: #fff;
        border-radius: 10px;
        font-size: 16px;
        display: inline-block;
    }

    .recebiveis {
        background-color: #fafafa;
        font-size: 14px;
        text-align: center;
        padding: 15px;
        margin-top: 20px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .footer {
        text-align: center;
        padding: 20px;
        font-size: 12px;
        color: #777;
        border-top: 1px solid #ddd;
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://alupeer.com/assets/logo/imagotipo-TriTone.png?v=1725251622"
                alt="Logo">
        </div>
        <div class="content">
            <h1>Olá, {{ $user->name }} 😃</h1>
            <p><strong>{{ $locador['name'] }}</strong> acabou de fazer uma reserva!</p>
            <p>Confira os detalhes.</p>

            <div class="informes">
                <img src="https://cdn.vectopus.com/laurareen/icons/041F57B6F1D5/128A48D30F77/icons-shopping-bag-paper-gift-shop-256.png"
                    alt="">
                <h3>Anúncio</h3>
                <span>{{ $item['name_item'] }}</span>
            </div>

            <div class="informesa">
                <div class="informes">
                    <img src="https://cdn.vectopus.com/laurareen/icons/041F57B6F1D5/E1846E3D74F1/icons-calendar-date-appointment-256.png"
                        alt="">
                    <h3>Datas</h3>
                </div>
                <ul>

                    @foreach($dates as $date)
                    <li><span>{{ $date }}</span></li>
                    @endforeach

                </ul>
            </div>

            <div class="informes">
                <img src="https://cdn.vectopus.com/laurareen/icons/041F57B6F1D5/49A6567B816E/icons-bill-invoice-price-256.png"
                    alt="">
                <h3>Valor</h3>
                <span>R${{ number_format($item['price'] * count($dates), 2, ',', '.') }}</span>
            </div>
        </div>
        <div class="button">
            <a href="{{env('APP_URL')}}/reservas">Ver reservas</a>
        </div>
        <div class="recebiveis">
            Um chat para conversar com <strong>{{ $locador['name'] }}</strong> já está disponível!
        </div>
        <div class="footer">
            <p>Enviado com ❤️ por {{ env('APP_NAME') }}</p>
        </div>
    </div>
</body>

</html>

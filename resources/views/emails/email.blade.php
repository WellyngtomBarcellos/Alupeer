<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo(a)!</title>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f4f4;
        color: #212121;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
    }

    .header {
        text-align: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .header img {
        height: 30px;
    }

    .content {
        padding: 20px;
        text-align: left;
    }

    .content h1 {
        font-size: 24px;
        color: #ef3c46;
    }

    .content p {
        font-size: 16px;
        line-height: 1.5;
    }

    .signature {
        margin-top: 30px;
        font-size: 16px;
    }

    .footer {
        text-align: center;
        padding: 20px;
        font-size: 12px;
        color: #777;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://alupeer.com/assets/logo/imagotipo-TriTone.png?v=1725251622" alt="Logo">
        </div>
        <div class="content">
            <h1>Olá, {{Auth::user()->name}}!</h1>
            <p><strong>Bem-vindo(a) à nossa comunidade!</strong></p>
            <p>
                Estamos muito felizes em ter você conosco. Aqui, você encontrará um espaço acolhedor e cheio de
                oportunidades para aprender, compartilhar e crescer. Não hesite em explorar todas as funcionalidades, e
                se precisar de ajuda, nossa equipe está sempre pronta para te apoiar. Juntos, vamos alcançar grandes
                coisas!
            </p>
            <div class="signature">
                <p>Atenciosamente,</p>
                <p><strong>Wellyngtom Barcellos, CEO</strong></p>
            </div>
        </div>
        <div class="footer">
            <p>Enviado com ❤️ por {{ env('APP_NAME') }}</p>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Mercado Pago</title>
</head>
<body>
    <h1>Comprar Som Automotivo</h1>
    <p>Descrição: Dummy description</p>
    <p>Preço: R$ 0,01</p>
    <button id='pay'>Pagar</button>
    <script>
        $('#pay').on('click', function() {
            $.ajax({
                url: '/mp-p',  // Adicione a URL correta da rota
                method: 'GET',  // Certifique-se de que o método está correto no backend
                success: function(response) {
                    // Acessa init_point corretamente usando `response.init_point`
                    window.location.href = response.init_point;
                },
                error: function(error) {
                    console.error('Erro ao criar a preferência de pagamento:', error);
                }
            });
        });
    </script>
</body>
</html>

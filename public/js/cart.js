/*
|--------------------------------------------------------------------------
|           Remover itens do Carrinho
|--------------------------------------------------------------------------
|
|       Essa configuração remove Itens individuais do carrinho
|       sem um recarregamento da página!
|
|
|
*/
$('.options_container').on('click', function () {
    var itemId = $(this).data('id');
    var $this = $(this); // Armazena o contexto para uso posterior no callback

    $.ajax({
        url: '/carrinho/remover',
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Atualiza o CSRF token dinamicamente
        },
        data: {
            id: itemId
        },
        success: function (response) {
            if (response.success) {
                // Remove o item da interface
                $this.closest('.item_container').remove();
                $(`.informate[data-id="${itemId}"]`).remove();

                // Atualiza a meta tag com os dados atualizados
                var updatedCart = JSON.stringify(response.cart); // Converte o carrinho atualizado para JSON
                $('meta[name="cart"]').attr('content', updatedCart);

                // Recalcula e atualiza o total
                var totalSum = 0;
                $('.total_price').each(function () {
                    var totalPrice = $(this).text().trim().replace('R$', '').replace('.', '').replace(',', '.');
                    totalSum += parseFloat(totalPrice);
                });

                // Obtém o valor atual como texto, converte para número, subtrai 1 e atualiza o texto
                $('.cart_num').text(function (i, text) {
                    var newValue = parseInt(text) - 1;
                    // Atualiza o texto do elemento
                    $(this).text(newValue);
                    // Se o novo valor for 0, esconda o elemento
                    if (newValue === 0) {
                        $('.show_cart').hide(); // Altere 'div' para o seletor correto se necessário
                    }
                });



                // Formata o total
                var formattedTotal = 'R$ ' + totalSum.toFixed(2).replace('.', ',');
                $('.formate_price').text(formattedTotal);
            } else {
                console.log('Falha ao remover o item:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Erro:', error);
        }
    });
});





/*
|--------------------------------------------------------------------------
|           Cria a reserva com status de AGUARDANDO
|--------------------------------------------------------------------------
|
|       Essa configuração cria uma reserva
|       com status de aguardando!
|
|
|
*/
function Bookinschedule(dates) {

    let buttonConfirm = $('.buttom')

    buttonConfirm.removeClass('buttom_reserve')
    buttonConfirm.html(`<span class="loaderine"></span>`)
    buttonConfirm.css('background', 'transparent')
    buttonConfirm.css('border', 'none')

    var payload = {
        dates: dates,
        _token: $('meta[name="csrf-token"]').attr('content')
    };


    $.ajax({
        url: '/store/booking',
        type: 'POST',
        data: payload,
        success: (response) => {
            if (response.success) {
                window.location.href = '/reservas';
            }
        },
        error: function (xhr, status, error) {

        }
    });

}



/*
|--------------------------------------------------------------------------
|    Adiciona ao Carrinho
|--------------------------------------------------------------------------
|
|   Essa Configuração recebe os dados do item e
|   Adiciona-o ao carrinho para checkout
|
|
*/
$('.buttom_reserve').on('click', function () {
    var cartData = $('meta[name="cart"]').attr('content');

    try {
        var parsedCartData = JSON.parse(cartData);
        Bookinschedule(parsedCartData);

    } catch (e) {
        console.error('Erro ao parsear o JSON do carrinho:', e);
    }
});

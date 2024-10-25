/*
|--------------------------------------------------------------------------
| Carregar URL para exibição do produto
|--------------------------------------------------------------------------
|
| ****
|
*/

let dateslist = [];
let itemId = ''

$(document).ready(function () {

    let loged = $('#user-loged').attr('user-id');
    let id = $('#user-owner').attr('user-owner');
    let product = $('#item-meta').attr('item-id');



    var produt_contat = $('.produt_contat');
    itemId = product;

    if (loged && id) {
        $('#check-out-date').css('display', 'block');
    }
    if (product === null) {
        produt_contat.css('display', 'none');
    }
});
















/*
|--------------------------------------------------------------------------
| Calendário de Seleção de Reservas
|--------------------------------------------------------------------------
|
| Cria uma promisse para checar os dias já alugados e
| exibe o calendário para seleção de reserva com os dias
| disponíiveis
|
*/

$(document).ready(function () {


    function unavailableDates() {
        return new Promise((resolve, reject) => {
            let item = $('#item-meta').attr('item-id');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/store/dates-unavaliable',
                type: 'GET',
                data: {
                    id: item,
                    _token: csrfToken,
                },
                success: function (response) {
                    if (Array.isArray(response)) {
                        let formattedDates = formatDates(response);
                        resolve(formattedDates);
                    } else {
                        reject('Resposta não é um array');
                    }
                },
                error: function (xhr, status, error) {
                    reject(error);
                }
            });
        });
    }
    function formatDates(dates) {
        return dates.map(date => {
            let parts = date.split('-');
            let day = parts[0];
            let month = parts[1];
            let year = parts[2];
            return `${year}-${month}-${day}`;
        });
    }
    function formatDate(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Janeiro é 0
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }
    function getDatesInRange(startDate, endDate) {
        const dates = [];
        let currentDate = new Date(startDate);

        while (currentDate <= endDate) {
            dates.push(formatDate(new Date(currentDate))); // Formata a data antes de adicionar ao array
            currentDate.setDate(currentDate.getDate() + 1);
        }

        return dates;
    }
    function formatDateToReadable(dateStr) {
        const months = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        const [day, month, year] = dateStr.split('-').map(Number);

        return `${day} de ${months[month - 1]} de ${year}`;
    }

    unavailableDates().then(store => {

        flatpickr("#check-out-date", {
            dateFormat: "Y-m-d",
            minDate: "today",
            mode: "range",
            disable: store,
            onChange: function (selectedDates) {

                if (selectedDates.length === 2) {
                    const startDate = selectedDates[0];
                    const endDate = selectedDates[1];

                    const startDateA = formatDate(startDate);
                    const endDateA = formatDate(endDate);


                    let priceDay = $('#pricing_loade').text();
                    let price = $('#item-price').attr('item-price');
                    const diffTime = Math.abs(endDate - startDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24) + 1);

                    dateslist = getDatesInRange(startDate, endDate, store);  // Use 'store' instead of 'unavailableDates'
                    const formattedDates = dateslist.map(formatDateToReadable);
                    if (dateslist.length > 0) {
                        let value = price * dateslist.length;
                        $('.info_total').css('display', 'flex');

                        $('.flutter_mobile').css('display', 'none')

                        $(".info_total").html(`
                            <div class="popup_reservation">
                                <div class="header-r">
                                    <i class="fa-solid fa-x close_reservation" onclick="closeReservation()"></i>
                                    <p>Agendar reserva</p>
                                    <span></span>
                                </div>
                                <div class="reserva-info">
                                    <h1>Adicionar reserva para ${diffDays} dias <br> no seu carrinho?</h1>
                                    <br>
                                    <div class="dates-review">
                                        <div class="check-in checjs">
                                            <p>Retirada</p>
                                            <p>${startDateA}</p>
                                        </div>
                                        <div class="check-out checjs">
                                            <p>Devolução</p>
                                            <p>${endDateA}</p>
                                        </div>
                                    </div>
                                    <p class="not-fee">Você não será cobrado ainda:</p>
                                    <div class="deta">
                                        <p>R$${price} x ${dateslist.length} dias</p>
                                        <p>R$${value}</p>
                                    </div>
                                    <div class="charges">
                                        <p>Valor total:</p>
                                        <p> R$${value}</p>
                                    </div>
                                    <p class="show_dates">Ver detalhes</p>

                                    <div class="detalhes_dates">
                                        <div class="container_date">
                                            <div class="dates-list">
                                                <p>Datas selecionadas:</p>
                                                <br>
                                                <ul>
                                                    ${formattedDates.map(date => `<li>${date}</li>`).join('')}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ReservarOk">
                                        Adicionar ao carrinho
                                    </div>
                                </div>
                            </div>
                        `);

                        // Attach event handlers
                        $('.show_dates').on('click', function () {
                            $('.detalhes_dates').css('display', 'flex');

                        });

                        $('.container_date').on('click', function () {
                            $('.detalhes_dates').css('display', 'none');
                        });

                        $('body').css('overflow', 'hidden');

                        $('.ReservarOk').on('click', function () {

                            $(this).removeClass('ReservarOk');
                            $(this).addClass('ButtonLoading');
                            $(this).html(`<span class="loaderine"></span>`);

                            $('.show_cart').show();

                            $('.cart_num').text(function (i, text) {
                                var newValue = parseInt(text) + 1;
                                $(this).text(newValue);
                            });

                            addCart(JSON.stringify(dateslist), itemId);
                        });
                    }
                }
            }
        });

    }).catch(error => {
        console.error('Erro ao buscar datas indisponíveis:', error);
    });

});







/*
|--------------------------------------------------------------------------
|           Adiciona item no carrinho
|--------------------------------------------------------------------------
|
|       Essa configuração cria uma reserva
|       no carrinho de compras
|
|
*/

function addCart(dates, item) {

    let dateInBook = ({ [item]: dates });



    $.ajax({
        url: '/addCart',
        type: 'POST',
        data: {
            item: dateInBook,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: (response) => {
            $('.info_total').html('');
            $('.info_total').css('display', 'none');
            $('body').css('overflow', 'auto');
        },
        error: (xhr, status, error) => {
            $('body').css('overflow', 'auto');
            console.error(error)
        }
    });

}






function closeReservation() {
    $('.info_total').html('')
    $('.info_total').css('display', 'none')
    $('body').css('overflow', 'auto')
    $('.headering').css('display', 'block')

    var largura = $(document).width();

    
    if (largura <= 700) {
        $('.flutter_mobile').css('display', 'flex')
    }
}


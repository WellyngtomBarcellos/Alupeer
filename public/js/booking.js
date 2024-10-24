/*
|--------------------------------------------------------------------------
| Verificação de step
|--------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| Altera Visualização de Seleção de datas na reserva
|--------------------------------------------------------------------------
*/
$('.show_dates').on('click', function () {
    $('.detalhes_dates').css('display', function (_, current) {
        return current === 'none' ? 'flex' : 'none';
    });
});








/*
|--------------------------------------------------------------------------
|   Altera Visualização de Seleção de datas na reserva
|--------------------------------------------------------------------------
*/
$('.container_date').on('click', function () {
    $('.detalhes_dates').toggle();
})









/*
|--------------------------------------------------------------------------
| Quando DOM carregar
|--------------------------------------------------------------------------
|
|
| ** **
|
|
*/

$(document).ready(function () {

    function toggleSections(activeBtn, activeDiv, inactiveBtn, inactiveDiv) {
        $(activeBtn).addClass('Active');
        $(inactiveBtn).removeClass('Active');
        $(activeDiv).show();
        $(inactiveDiv).hide();
    }

    $('.rents_btn').on('click', function () {
        toggleSections('.rents_btn', '.your_anounce', '.anounce_btn', '.your_booking');
        $('.cont p').html('Aqui você pode <strong>gerenciar</strong> todos os seus pedidos de aluguel.')
    });

    $('.anounce_btn').on('click', function () {
        toggleSections('.anounce_btn', '.your_booking', '.rents_btn', '.your_anounce');
        $('.cont p').html('Aqui você pode <strong>gerenciar</strong> todos os seus <strong>anúncios</strong>.')
    });

    function formatDateToReadable(dateStr) {
        const months = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        const [day, month, year] = dateStr.split('-').map(Number);

        return `${day} de ${months[month - 1]} de ${year}`;
    }

    $('.myBooking').on('click', function () {
        var dataId = $(this).data('id');
        let item = parseInt(dataId)
        var popup = $('#popup_informations')

        popup.html(dataId)
        popup.css('display', 'flex')
        $('body').css('overflow', 'hidden')


        $.ajax({
            url: '/Bookin/data',
            type: 'GET',
            data: {
                _token: '{{csrf_token()}}',
                item: item
            },
            beforeSend: () => {
                $('#popup_informations').css('display', 'flex')
                $('#popup_informations').html(`<div class="informate"></div>`)
            },
            success: (response) => {



                let dateArray;
                let optioners

                if (typeof response.booking.date === 'string') {
                    try {
                        dateArray = JSON.parse(response.booking.date);
                    } catch (error) {
                        console.error('Erro ao analisar JSON:', error);
                        return;
                    }
                } else {
                    dateArray = response.booking.date;
                }

                if (Array.isArray(dateArray)) {
                    const formattedDates = dateArray.map(formatDateToReadable);
                    const dateListItems = formattedDates.map(dateString => `<li>${dateString}</li>`).join('');

                    let days = dateArray.length
                    let item_name = response.booking.item['name_item']
                    let price = response.booking.item['price'] * days

                    let formattedPrice = new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(price);












                    let statusCheck = () => {
                        const { reservado, devolvido } = response.booking;
                    
                        if (!devolvido) {
                            return  reservado === 1 ? 'step-1' :
                                    reservado === 2 ? 'step-2' :
                                    reservado === 3 ? 'step-3' :
                                    reservado === 4 ? 'step-4' : '';
                        }
                        return ''; 
                    };

                    let currentStep = statusCheck();

                    switch (currentStep) {
                        case 'step-1':
                            console.log('Step 1 - Apenas agendado');
                            optioners = `
                                <div class="optioner">
                                    <div class="btnss confirm">Confirmar</div>
                                    <div class="btnss deny">Cancelar</div>
                                </div>`;
                            break;
                    
                        case 'step-2':
                            console.log('Step 2 - Aceito pelo locador');
                            optioners = `
                                <div class="optioner">
                                    <div class="btnss start">Reserva Confirmada</div>
                                </div>`;
                            break;
                    
                        case 'step-3':
                            console.log('Step 3 - Finalizar e marcar como devolvido');
                            optioners = `
                                <div class="Sendback">
                                    <div class="btnss devolver_btn">Marcar como devolvido</div>
                                </div>`;
                            break;
                    
                        case 'step-4':
                            console.log('Step 4 - Em revisão');
                            optioners = `
                                <div class="Sendback">
                                    <div class="btnss finalizada">Reserva finalizada</div>
                                </div>`;
                            break;
                    
                        default:
                            optioners = `
                                <div class="Sendback">
                                    <div class="btnss finalizada">Reserva finalizada</div>
                                </div>`;
                            break;
                    }



                    

                    if (optioners) {
                        $('#someContainer').html(optioners);
                        $('.confirm').on('click', function() {
                            console.log('Confirmar clicado');
                        });
                    
                        $('.deny').on('click', function() {
                            console.log('Cancelar clicado');
                        });
                    
                        $('.devolver_btn').on('click', function() {
                            console.log('Devolução marcada');
                        });
                    }




















                    $('#popup_informations').html(`
                        <div class="informate">

                        <div class="header">
                            <ion-icon class="close_reserva" name="close"></ion-icon>
                            <span>Reservas</span>
                            <span></span>
                        </div>

                        <div class="conteudo-informativo">
                            <h1>Detalhes da reserva</h1>

                            <div class="division_A">
                                <a target="_blank" href="/user/${response.booking.user['id']}">
                                    <div class="userdetail">
                                        <div class="userpricture">
                                            <img loading="lazy" src="${response.booking.user['avatar']}" alt="profile pic">
                                        </div>
                                        <p>${response.booking.user['name']}</p>
                                    </div>
                                </a>
                                <a class="link_pro" href="/produto/${response.booking.item['token']}">
                                <div class="userdetail">
                                        <div class="userpricture">
                                            <img loading="lazy" src="${response.booking.img[0]['link']}" alt="profile pic">
                                        </div>
                                        <p>${item_name}</p>
                                    </div>
                                </a>
                            </div>
                            <hr>
                            <br>

                            <h2>Reservado para ${days} dia(s)</h2>

                            <ul class="ul_item">
                                ${dateListItems}
                            </ul>
                            <br>
                        </div>

                        <h2>Total: ${formattedPrice}</h2>

                        ${optioners}

                    </div>`);

                    popup.off('click', '.close_reserva').on('click', '.close_reserva', function () {
                        popup.html('');
                        popup.css('display', 'none');
                        $('body').css('overflow', 'auto');
                    });

                    popup.off('click', '.confirm').on('click', '.confirm', function () {
                        langolango(item);
                    });

                    popup.off('click', '.deny').on('click', '.deny', function () {
                        pataquada(item);
                    });

                    popup.off('click', '.devolver_btn').on('click', '.devolver_btn', function () {
                        $.ajax({
                            data: { item: item },
                            type: 'GET',
                            url: '/Bookin/make/devolvido',
                            complete: (res) => {

                            },
                            success: (res) => {
                                if (res.success) {
                                    $('.informate').html(`${res.view}<p>${res.message}</p>`).css('display', 'flex').css('justify-content', 'center').css('align-items', 'center').css('flex-direction', 'column')

                                    setTimeout(() => {
                                        $('.informate').html('')
                                        $('#popup_informations').hide()
                                        $('body').css('overflow', 'auto')
                                    }, 5500);
                                }
                            },
                            error: (res) => { },

                        })
                    });

                } else {
                    console.error('Datas incorretas ou não definidas');
                }
            },
            error: () => { },
            complete: () => { }
        });

    });

    $('.myOrders').on('click', function () {
        var dataId = $(this).data('id');
        let item = parseInt(dataId)
        var popup = $('#popup_informations')

        popup.html(dataId)
        popup.css('display', 'flex')
        $('body').css('overflow', 'hidden')


        $.ajax({
            url: '/Bookin/data',
            type: 'GET',
            data: {
                _token: '{{csrf_token()}}',
                item: item
            },
            beforeSend: () => {
                $('#popup_informations').css('display', 'flex')
                $('#popup_informations').html(`<div class="informate"></div>`)
            },
            success: (response) => {
                let dateArray;
                let optioners

                if (typeof response.booking.date === 'string') {
                    try {
                        dateArray = JSON.parse(response.booking.date);
                    } catch (error) {
                        console.error('Erro ao analisar JSON:', error);
                        return;
                    }
                } else {
                    dateArray = response.booking.date;
                }

                if (Array.isArray(dateArray)) {
                    const formattedDates = dateArray.map(formatDateToReadable);
                    const dateListItems = formattedDates.map(dateString => `<li>${dateString}</li>`).join('');
                    let days = dateArray.length
                    let item_name = response.booking.item['name_item']
                    let price = response.booking.item['price'] * days

                    let formattedPrice = new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(price);




                    let statusCheck = () => {
                        const { reservado, devolvido } = response.booking;
                    
                        if (!devolvido) {
                            return  reservado === 1 ? 'step-1' :
                                    reservado === 2 ? 'step-2' :
                                    reservado === 3 ? 'step-3' :
                                    reservado === 3 ? 'step-4' : ''
                        }
                        return ''; 
                    };

                    let currentStep = statusCheck();

                    switch (currentStep) {
                        case 'step-1':
                            console.log('Step 1 - Apenas agendado');
                            optioners = `
                                <div class="optioner">
                                    <div class="btnss deny">Cancelar</div>
                                </div>`;
                            break;
                    
                        case 'step-2':
                            console.log('Step 2 - Aceito pelo locador');
                            optioners = `
                                <div class="optioner">
                                    <div class="btnss start">Iniciar uso</div>
                                </div>`;
                            break;
                    
                        case 'step-3':
                            console.log('Step 3 - Finalizar e marcar como devolvido');
                            optioners = `
                                <div class="Sendback">
                                    <div class="btnss devolver_btn">Marcar como devolvido</div>
                                </div>`;
                            break;
                    
                        case 'step-4':
                            console.log('Step 4 - Em revisão');
                            optioners = `
                                <div class="Sendback">
                                    <div class="btnss finalizada">Reserva finalizada</div>
                                </div>`;
                            break;
                    
                        default:
                            console.log('Step 5 - Avaliação');
                            optioners = `<div class="Sendback">
                                        <div class="reviewdata">Avaliar</div>
                                    </div>`
                            break;
                    }


                        if (response.reviewStatus.message == 'avaliado') {
                            optioners = `<div class="Sendback">
                                            <div class="compleeted">Pedido finalizado</div>
                                        </div>`
                        }





                    $('#popup_informations').html(`
                        <div class="informate">

                        <div class="header">
                            <ion-icon class="close_reserva" name="close"></ion-icon>
                            <span>Reservas</span>
                            <span></span>
                        </div>

                        <div class="conteudo-informativo">
                            <h1>Detalhes da reserva</h1>

                            <div class="division_A">
                                <a target="_blank" href="/user/${response.booking.user['id']}">
                                    <div class="userdetail">
                                        <div class="userpricture">
                                            <img loading="lazy" src="${response.booking.user['avatar']}" alt="profile pic">
                                        </div>
                                        <p>${response.booking.user['name']}</p>
                                    </div>
                                </a>
                                <a class="link_pro" href="/produto/${response.booking.item['token']}">
                                <div class="userdetail">
                                        <div class="userpricture">
                                            <img loading="lazy" src="${response.booking.img[0]['link']}" alt="profile pic">
                                        </div>
                                        <p>${item_name}</p>
                                    </div>
                                </a>
                            </div>
                            <hr>
                            <br>

                            <h2>Reservado para ${days} dia(s)</h2>

                            <ul class="ul_item">
                                ${dateListItems}
                            </ul>
                            <br>
                        </div>

                        <h2>Total: ${formattedPrice}</h2>
                        ${optioners}

                    </div>`);

                    popup.off('click', '.close_reserva').on('click', '.close_reserva', function () {
                        popup.html('');
                        popup.css('display', 'none');
                        $('body').css('overflow', 'auto');
                    });

                    popup.off('click', '.confirm').on('click', '.confirm', function () {
                        langolango(item);
                    });

                    popup.off('click', '.deny').on('click', '.deny', function () {
                        pataquada(item);
                    });
                    popup.off('click', '.reviewdata').on('click', '.reviewdata', function () {



                        $('#popup_informations').html(`<div class="informate">carregando</div>`)

                        $.ajax({
                            url: '/tripple',
                            type: 'GET',
                            data: {
                                _token: '{{csrf_token()}}',
                                item: item
                            },
                            success: (response) => {
                                $('#popup_informations').html(`<div class="informate" data-item="${item}" style="display:flex;justify-content:center;alighn-items:center;">
                                    ${response}
                                    </div>`)

                            },
                            error: () => { },
                            complete: () => { }
                        })



                    });

                } else {
                    console.error('Datas incorretas ou não definidas');
                }
            },
            error: () => { },
            complete: () => { }
        });

    });

});





/*
|--------------------------------------------------------------------------
| Aceitar Reserva
|--------------------------------------------------------------------------
|
| Essa configuração cria uma Reserva nas datas selecionadas
| e atualiza o status no banco de dados
|
*/
function langolango(id) {

    $('#popup_informations').html(`<div class="informate">Loading</div>`)

    $.ajax({
        url: '/Bookin/data/accept-booking',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            item: id
        },
        success: (response) => {

            $('#popup_informations').html(`
                    <div class="informate">
                    ${response.html}
                    <p class="confirmada">Reserva confirmada</p>
                    </div>
                    `)

            var row = $(`tr[data-id="${id}"]`);

            row.removeClass('wait')
            row.find('td.status').removeClass('wait');
            row.find('td.status').addClass('rented');

            setTimeout(function () {
                $('#popup_informations').html(``)
                $('#popup_informations').css('display', 'none')
            }, 3000);



        },
        error: () => {

        },
        complete: () => {

        }
    });


}





/*
|--------------------------------------------------------------------------
| Nega Reserva
|--------------------------------------------------------------------------
|
| Essa configuração Nega uma Reserva
| e atualiza o status no banco de dados
|
*/
function pataquada(id) {

    $('#popup_informations').html(`<div class="informate">Loading</div>`)

    $.ajax({
        url: '/Bookin/data/delete-booking',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            item: id
        },
        success: (response) => {
            $('#popup_informations').html(`
                    <div class="informate">
                    ${response.html}
                    <p class="confirmada">Reserva Cancelada</p>
                    </div>
                    `)

            var row = $(`.books[data-div="${id}"]`);
            if (row.length) {
                row.css('display', 'none');

            } else {

            }


            setTimeout(function () {
                $('#popup_informations').html(``)
                $('#popup_informations').css('display', 'none')
            }, 3000);
        },
        error: () => {

        },
        complete: () => {

        }
    });
}





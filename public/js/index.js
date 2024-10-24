/*
|--------------------------------------------------------------------------
|    Variáveis GLOBAIS
|--------------------------------------------------------------------------
|
| Variáveis para armazenar o cadastro do produto
|
*/

category = ''
description = ''
float = ''
product_name = ''
price = ''
imageList = []
lat = ''
long = ''
posttoken = ''
is_editing = false


/*
|--------------------------------------------------------------------------
| ...
|--------------------------------------------------------------------------
|
|
|
*/
$(document).ready(function () {
    $('.btn_misc').on('click', function (event) {
        event.stopPropagation();
        var option = $(this).closest('.card_item').find('.option');
        var dataItem = option.data('item');
        $('.option').css('display', 'none');
        option.slideDown(100);
    });
    $(document).on('click', function () {
        $('.option').slideUp();
        $('#Option').css('display', 'none');
        $('#Notification_list').css('display', 'none');
    });
    $('.close_listing').on('click', function () {
        $('.listing').slideUp(100)
    });
    $('.more_anounce').on('click', function () {
        $('.listing').slideDown(100)
    });
});

$('.cancel_exclusion').on('click', function (event) {
    var popup = $('#popup')
    popup.html('')
    popup.css('display', 'none')
});









/*
|--------------------------------------------------------------------------
| Deletar Anuncio * Popup
|--------------------------------------------------------------------------
|
| Abra o popup de confimação para excluir anuncio
|
*/

function deleteAnounce(id) {
    var popup = $('#popup')
    $('.close_listing').click()
    popup.html(`
        <div class="main">
            <div class="headerring">
                <h1>Deseja Deletar esse anúncio ?</h1>
                <p>Uma vez deletado as informações serão excluidas permanentemente!</p>
            </div>
            <div class="choose">
                <span onclick="deletePost('${id}')" class="confirm_exclusion">Confirmar</span>
                <span onclick="cancel()" >Cancelar</span>
            </div>
        </div>`)

    popup.css('display', 'flex')
}








/*
|--------------------------------------------------------------------------
| Cancelar Delete
|--------------------------------------------------------------------------
|
| Fecha o popup de Exclusão
|
*/

function cancel() {
    var popup = $('#popup')
    popup.css('display', 'none')
    popup.html('')
}










/*
|--------------------------------------------------------------------------
| Deletar Anuncio
|--------------------------------------------------------------------------
|
| Deletar em cascata todos os objetos do anuncio
|
*/
function deletePost(id) {
    
    var popup = $('#popup')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: "/user/anounce/delete",
        method: 'POST',
        data: {
            id: id,
        },
        success: function (response) {
            if (response.success) {
                location.reload()
            }
        },
        error: function (xhr, status, error) {
            console.warn('Sem permissão para essa funcionalidade!')
        },
        complete: function () {

            popup.html('')
            popup.css('display', 'none')
        }
    });

}









/*
|--------------------------------------------------------------------------
| Compartilhar
|--------------------------------------------------------------------------
|
| Copia link do anuncio
|
*/
function shareLink(id) {
    var link = location.href;
    var baseUrl = link.split('user')[0] + 'produto/' + id;
    var tempInput = document.createElement('input');
    tempInput.value = baseUrl;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    $('.close_listing').click()
}










/*
|--------------------------------------------------------------------------
| Editar anuncio
|--------------------------------------------------------------------------
|
| Abre um popup para edição do anuncio
|
*/

function editAnounce(id) {
    $('.close_listing').click()
    var popup = $('#popup');
    showLoader()
    posttoken = id
    $.ajax({
        url: "/anounce/edit",
        method: 'GET',
        data: {
            id: id
        },
        success: function (response) {
            popup.html(response);
            popup.css('display', 'flex');
            is_editing = true
            hideLoader()
        },
        error: function (xhr, status, error) {
            console.error('Erro ao carregar o componente:', error);
            popup.html('<p>Falha ao carregar o conteúdo.</p>');
            popup.css('display', 'flex');
        }
    });
}











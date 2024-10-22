/*
|--------------------------------------------------------------------------
| Exibir loader de carregamento SPA
|--------------------------------------------------------------------------
|
|
|
*/
function showLoader(duration) {
    duration = duration || 500
    $('#loader').css({
        width: '0%',
        display: 'flex'
    });
    $('#loader').animate({ width: '100%' }, duration, function () {
        $(this).css('display', 'none');
    });
}
function hideLoader() {
    $('#loader').stop(true)
    $('#loader').css('display', 'none')
}


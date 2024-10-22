/*
|--------------------------------------------------------------------------
| Carrossel de Imagem na página do produto
|--------------------------------------------------------------------------
|
| ****
|
*/

$(document).ready(function () {
    var $carousel = $('.main-carousel').flickity({
        cellAlign: 'left',
        contain: false,
        pageDots: false,
        autoPlay: true,
        fullscreen: true
    });
});



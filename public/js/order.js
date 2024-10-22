$(document).ready(function () {
    var url = window.location.href;
    var path = url.split('chatify/')[1];

    if (path) {
        var pathParts = path.split('?');
        var id = pathParts[0];
        var queryString = pathParts[1] || '';
        var queryParams = new URLSearchParams(queryString);
        var product = queryParams.get('product');
        if (id && product) {
            $.ajax({
                url: "/data/chat/informations",

                method: 'GET',
                data: {
                    _token: csrfToken,
                    id: id,
                    item: product
                },
                success: function (response) {
                    let nameItem = $('#name_item');
                    let nameItemHeader = $('#name_itemHeader');
                    let loadImage = $('#load_image');
                    let show = $('.image_loade');
                    let pricing_loade = $('#pricing_loade');
                    let details = $('.details span');
                    nameItem.text(response.produto.name_item);
                    nameItemHeader.text(response.produto.name_item);
                    pricing_loade.text('R$' + response.produto.price);
                    details.text(response.produto.descricao);
                    if (response.produto.images.length > 0) {
                        loadImage.attr('src', response.produto.images[0].link);
                        show.css('display', 'flex');
                    }
                }
                ,

                error: function (xhr, status, error) {
                },
                complete: function () {
                }
            });
        }


    }
});

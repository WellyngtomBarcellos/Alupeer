<div id="next_step"><span>Próximo</span></div>

<script>
$('#next_step').on('click', function() { //Localização
    var locationContainer = $('#Location_Selection');
    var floatContainer = $('#Float_Selection');
    if (locationContainer.is(':visible') && lat !== '' && long !== '') {
        locationContainer.fadeOut(600)
        setTimeout(function() {
            floatContainer.fadeIn(600);
        }, 600)
        $('.line').css('width', '25%')
    }
    $('#next_step').css('display', 'none')

})

function next_step() { // Float
    var floatContainer = $('#Float_Selection');
    var categoryContainer = $('#Category_Selection');

    if (floatContainer.css('display') === 'block' && float !== '') {
        floatContainer.fadeOut(600)
        setTimeout(function() {
            categoryContainer.fadeIn(600);
        }, 600)
        $('.line').css('width', '37.5%')
    }
}

function third_step() { // Categoria
    var categoryContainer = $('#Category_Selection');
    var titleContainer = $('#Title_Selection');

    if (categoryContainer.css('display') === 'block' && category !== '') {
        categoryContainer.fadeOut(600)
        setTimeout(function() {
            titleContainer.fadeIn(600);
        }, 600)
        $('.line').css('width', '50%')
    }
}

function quart_step() { // Nome do produto
    var titleContainer = $('#Title_Selection');
    var descContainer = $('#Description_Selection');


    if (titleContainer.css('display') === 'block' && product_name !== '') {
        titleContainer.fadeOut(600)
        setTimeout(function() {
            descContainer.fadeIn(600);
        }, 600)
        $('.line').css('width', '62.5%')
    }
}

function steper_step() { // Descrição
    var descContainer = $('#Description_Selection');
    var priceContainer = $('#Price_Selection');

    if (descContainer.css('display') === 'block' && description !== '') {
        descContainer.fadeOut(600)
        setTimeout(function() {
            priceContainer.fadeIn(600);

        }, 600)
        $('.line').css('width', '75%')
    }
}


function quint_step() { // Preço
    var priceContainer = $('#Price_Selection');
    var imageContainer = $('#Images_Selection');
    var btn = $('.contianer');

    var priceInput = $("#price_input").val();
    price = parseFloat(priceInput);

    if (priceContainer.is(':visible') && price !== '') {
        priceContainer.fadeOut(600, function() {
            imageContainer.fadeIn(600);
        });

        setTimeout(function() {
            btn.fadeIn(600);
            $('.line').css('width', '87.5%');
        }, 600);
    }
}
</script>

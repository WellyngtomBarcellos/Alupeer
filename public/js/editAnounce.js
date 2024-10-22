$(document).ready(function () {

    function showElement(selector, buttonClass) {
        var windowWidth = $(window).width();
        $('#productname, #productcategory, #productflaot, #productprice, #productdesc').css('display', 'none');
        $(selector).css('display', 'flex');
        $('.save_btn').removeClass('title-active category-active float-active price-active desc-active');
        $('.save_btn').addClass(buttonClass);

        if (windowWidth <= 840) {

            $('body').css('overflow', 'hidden')
            $('#edit_area').show()
        }

    }

    $('.title_div').on('click', function () {
        showElement('.productname', 'title-active');
    });

    $('.category_div').on('click', function () {
        showElement('.productcategory', 'category-active');
    });

    $('.float_div').on('click', function () {
        showElement('.productflaot', 'float-active');
    });

    $('.price_div').on('click', function () {
        showElement('.productprice', 'price-active');
    });

    $('.desc_div').on('click', function () {
        showElement('.productdesc', 'desc-active');
    });

    $('#close_edit_container').on('click', () => {
        $('#edit_area').hide()
        $('body').css('overflow', 'auto')
    })






    function handleAjaxUpdate(url, data, updateSelector, updateValue, displayValue = updateValue) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id: idProd,
                ...data,
                _token: csrfToken,
            },
            success: (response) => {
                if (response.success) {
                    $(updateSelector).text(displayValue);
                    $('.save_btn').text('Sucesso').css('background', 'var(--blue)');
                    $('.components').hide();


                    setTimeout(() => {
                        $('.save_btn').text('Salvar').css('background', 'var(--colorBlack_)');
                    }, 2000);

                    var windowWidth = $(window).width();
                    if (windowWidth <= 840) {
                        $('#edit_area').hide()
                        $('body').css('overflow', 'auto')
                    }

                }
            },
            error: (xhr, status, error) => {
                var windowWidth = $(window).width();
                if (windowWidth <= 840) {
                    $('#edit_area').hide()
                    $('body').css('overflow', 'auto')
                }
                console.error('Erro:', error);
            }
        });
    }

    $(document).on('click', '.title-active', () => {
        handleAjaxUpdate('edit/anounce/name', { name: $('#textname').val() }, '.name_item', $('#textname').val());
    });

    $(document).on('click', '.category-active', () => {
        handleAjaxUpdate('edit/anounce/category', { category: $('select[name="categoria"]').val() }, '.category_product', $('select[name="categoria"]').val());
    });

    $(document).on('click', '.float-active', () => {
        handleAjaxUpdate('edit/anounce/float', { float: $('select[name="float"]').val() }, '.float_product', $('select[name="float"]').val());
    });

    $(document).on('click', '.price-active', () => {
        const price = $('input[name="price"]').val();
        handleAjaxUpdate('edit/anounce/price', { price: price }, '.price_product', price, 'R$' + price + '/dia');
    });

    $(document).on('click', '.desc-active', () => {
        handleAjaxUpdate('edit/anounce/desc', { description: $('textarea[name="descricao"]').val() }, '.desc_product', $('textarea[name="descricao"]').val());
    });





    updateCharCount();
    $('#textname').on('input', function () {
        updateCharCount();
    });
    function updateCharCount() {
        var text = $('#textname').val();
        var maxLength = $('#textname').attr('maxlength');
        var remaining = maxLength - text.length;
        $('#charCount').text(remaining);
    }





    var $textarea = $('#textdesc');
    var $charCount = $('#descCharCount');
    var maxLength = $textarea.attr('maxlength');
    function updateCharCountA() {
        var currentLength = $textarea.val().length;
        var remainingLength = maxLength - currentLength;
        $charCount.text(remainingLength);
    }
    updateCharCountA();
    $textarea.on('input', updateCharCountA);







});




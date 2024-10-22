
$(document).ready(function () {
    let isAtBottom = false;
    let isLoading = false;
    let nextPageUrl = '';
    errorCallback('/result');


    /*
    |--------------------------------------------------------------------------
    | Infinity Scroll
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    $(document).on('scroll', function () {
        let container = $('#container_Anunce');
        let containerOffset = container.offset().top + container.outerHeight();
        let windowHeight = $(window).height();
        let scrollPosition = $(window).scrollTop() + windowHeight;

        if (scrollPosition >= containerOffset - 100) {
            if (!isAtBottom) {
                isAtBottom = true;
                fetchItems(nextPageUrl, {}, true);
            }
        } else {
            isAtBottom = false;
        }
    });






    /*
    |--------------------------------------------------------------------------
    | Card Template
    |--------------------------------------------------------------------------
    |
    | Usado para renderizar os anuncios na Home
    |
    */

    const itemTemplate = (item) => `
    <a class="link_to_item" href="/produto/${item.token}">
        <div class="card_container">
            <div class="img_Product">
                <img loading="lazy" src="${item.images.length > 0 ? item.images[0].link : '/path/to/default-image.jpg'}" alt="${item.name_item}">
                ${item.distancia ? `<span title="Perto de você" class="description_Distance">PRÓXIMO DE VOCÊ</span>` : ''}
            </div>
            <div class="sider">
                <div class="description_Product">
                    <p title="Título">${item.name_item}</p>
                </div>
                <div class="description_Detail">
                    <a class="username" href="/user/${item.owner}">${item.users.name}</a>
                    <p class="description_Price">R$${item.price}<span>/dia</span></p>
                </div>
            </div>
        </div>
    </a>
    `;



















    /*
    |--------------------------------------------------------------------------
    | Obter Localização do usuário DESCOMENTAR quando o ADSSENSE FOR APROVADO
    |--------------------------------------------------------------------------
    |
    | Autoriza ou Nega a localização para entrega de produtos próximos
    |
    */



    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) { successCallback('/result/local', position) },
            function () { errorCallback('/result') }
        );
    }





















    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    |
    | Chama a função para renderizar os cards em caso de produtos não encontrado
    | ele exibe outra seção
    |
    */

    function renderItems(container, response, append = false) {
        if (!append) {
            container.empty(); // Limpa o container se não for para anexar
        }
        if (response.data.length > 0) {
            response.data.forEach(item => {
                var html = itemTemplate(item);
                container.append(html);
            });
        } else {
            if (!append) {
                container.html(`
                    <div class='no-results'>
                    <h1>Eita, Não encontrei o que procurava🥺</h1>
                    <p>Tente de novo, tenho certeza que vou encontrar!</p></div>`);
            }
        }
    }









    /*
    |--------------------------------------------------------------------------
    |  FETCH
    |--------------------------------------------------------------------------
    |
    | Chama uma consulta com dados definidos no banco de dados
    | (Usado para carregar os  cards)
    |
    */

    function fetchItems(url, data = {}, append = false) {
        showLoader();
        isLoading = true;

        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            success: function (response) {
                var container = $('#Main_List');
                renderItems(container, response, append);

                nextPageUrl = response.next_page_url;

                if (!nextPageUrl) {
                    isLoading = false;
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            },
            complete: function () {
                hideLoader();
                isLoading = false;
            }
        });
    }














    /*
    |--------------------------------------------------------------------------
    | Função para recomendar produtos próximos
    |--------------------------------------------------------------------------
    |
    | Busca todos os produtos proximo do usuario antes da renderização
    |
    */

    function successCallback(url, position, data) {
        data = data || {};
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        data.latitude = latitude;
        data.longitude = longitude;
        const queryString = $.param(data);
        const requestUrl = `${url}?${queryString}`;
        fetchItems(requestUrl);
    }














    /*
    |--------------------------------------------------------------------------
    | Função para carregar produtos sem localização
    |--------------------------------------------------------------------------
    |
    |   Busca todos os produtos antes de renderizado
    |
    */

    function errorCallback(url, data) {
        data = data || {};
        const queryString = $.param(data);
        const requestUrl = `${url}?${queryString}`;
        fetchItems(requestUrl);
    }


















    /*
    |--------------------------------------------------------------------------
    | Input de Pesquisa de produtos
    |--------------------------------------------------------------------------
    |
    | Captura os dados do input de pesquisa
    |
    */

    function handleSearchInput(searchInputSelector) {
        var search_input = $(searchInputSelector).val();
        var container = $('#Main_List');
        container.empty();
        setTimeout(function () {
            errorCallback('/search', {
                query: search_input
            });
        }, 500);

    }
    let debounceTimer;
    $('#search_input').on('input', function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {
            handleSearchInput('#search_input');
        }, 300); // 300ms delay
    });
    $('#search_input_mobile').on('input', function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {
            handleSearchInput('#search_input_mobile');
        }, 300); // 300ms delay
    });
















    /*
    |--------------------------------------------------------------------------
    | Clique de Categoria
    |--------------------------------------------------------------------------
    */

    $('.lists_category a').on('click', function () {
        var category = $(this).find('span').data('category');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {

                    successCallback('/result/category/local', position, {
                        category: category
                    });
                },
                function () {
                    errorCallback('/result/category/', {
                        category: category
                    });
                }
            );
        }


    });

















    /*
    |--------------------------------------------------------------------------
    | Funções do Filtro de Pesquisa avançada
    |--------------------------------------------------------------------------
    */

    const activeColor = "#3e51fc";
    const inactiveColor = "#d8d8d8";
    $("#inputRange").on("input", function () {
        const ratio = (this.value - this.min) / (this.max - this.min) * 100;
        $(this).css("background",
            `linear-gradient(90deg, ${activeColor} ${ratio}%, ${inactiveColor} ${ratio}%)`);
        $(this).siblings("p").text(this.value + "km");
    });
    $('.filter_btn').on('click', function () {
        var Filterlist = $('#Filterlist')
        Filterlist.css('display', 'flex')
        $('body').css('overflow', 'hidden')
    })
    $('.close_filterlist').on('click', function () {
        var Filterlist = $('#Filterlist')
        $('body').css('overflow', 'auto')
        Filterlist.css('display', 'none')
    })
    $('.filter_search').on('click', function (event) {
        event.preventDefault();

        // Coleta manual dos dados do formulário
        var range = $('#inputRange').val();
        var minPrice = $('#Filterlist input[name="min_price"]').val();
        var maxPrice = $('#Filterlist input[name="max_price"]').val();
        var Filterlist = $('#Filterlist')
        // Coleta dos valores das checkboxes
        var categories = [];
        $('#Filterlist input[name="categories"]:checked').each(function () {
            categories.push($(this).val());
        });

        var formData = {
            range: range,
            minPrice: minPrice,
            maxPrice: maxPrice,
            categories: categories
        };

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    successCallback('/filter-advanced/local', position, formData);
                    Filterlist.hide()
                    $('body').css('overflow', 'auto')

                },
                function () {
                    errorCallback('/filter-advanced/all', formData);
                    Filterlist.hide()
                    $('body').css('overflow', 'auto')
                }
            );
        }
    });

});

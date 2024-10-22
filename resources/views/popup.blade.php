
    <link rel="stylesheet" href="{{asset('css/popupReview.css')}}?v={{ time() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


        <div class="container_main">
            <div class="header">
                <h1>Classifique sua experiência!</h1>

            </div>
            <div class="star-rating">
                <input type="checkbox" id="star1" class="star" data-value="1">
                <label for="star1">&#9733;</label>

                <input type="checkbox" id="star2" class="star" data-value="2">
                <label for="star2">&#9733;</label>

                <input selected  type="checkbox" id="star3" class="star" data-value="3">
                <label for="star3">&#9733;</label>

                <input type="checkbox" id="star4" class="star" data-value="4">
                <label for="star4">&#9733;</label>

                <input type="checkbox" id="star5" class="star" data-value="5">
                <label for="star5">&#9733;</label>
                <p id="rating-result">Avaliação: 3 estrelas</p>
            </div>

            <textarea name="review" id="review_review" maxlength="50" cols="30" rows="10" placeholder="Insira seu comentário"></textarea>
            <span>0/50</span>

            <button id="send_review">Enviar</button>

        </div>


    <script>
$(document).ready(function() {
    var selectedRating = 3;
    highlightStars(selectedRating);
    $('.star').click(function() {
        selectedRating = $(this).data('value');
        $('#rating-result').text('Avaliação: ' + selectedRating + ' estrelas');
        highlightStars(selectedRating); // Atualiza as estrelas após o clique
    });
    function highlightStars(value) {
        $('.star').next('label').removeClass('selected'); // Remove a classe 'selected' de todas
        $('.star').each(function() {
            if ($(this).data('value') <= value) {
                $(this).next('label').addClass('selected'); // Adiciona 'selected' até a estrela clicada
            }
        });
    }







    $('#send_review').on('click', ()=>{

        selectedRating = selectedRating
        RatinText = $('#review_review').val()
        var itemValue = $('.informate').data('item');




        $.ajax({

            url:'review/send',
            data: {
                star:selectedRating,
                text:RatinText,
                id:itemValue
            },

            type: 'GET',

            success: (response) =>{
                if(response.success){
                    $('.informate').html(`${response.view}<p>${response.message}</p>`).css('display','flex').css('justify-content','center').css('align-items','center').css('flex-direction','column')

                    setTimeout(() => {
                        $('.informate').html('')
                        $('#popup_informations').hide()
                        $('body').css('overflow','auto')
                    }, 5500);
                }
            },
            error: (response) =>{
                $('.informate').html(`${response.view}<p>${response.message}</p>`).css('display','flex').css('justify-content','center').css('align-items','center').css('flex-direction','column')

                    setTimeout(() => {
                        $('.informate').html('')
                        $('#popup_informations').hide()
                        $('body').css('overflow','auto')
                    }, 3500);

            },

            complete: () =>{}
        })



    })



});
</script>

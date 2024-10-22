<div id="Title_Selection">
    <h1>Oquê você está anunciando?</h1>
    <p>Use o Nome ou Marca do produto para facilitar a busca pelos usuários <br>
        Mas não se preocupe, isso pode ser alterado mais tarde!
    </p>

    <textarea id="product_name" maxlength="32"></textarea>
    <br>
    <span id="char_count">0/32</span>

    <div id="next_step_two" onclick="quart_step()"><span>Próximo</span></div>
</div>

<script>
$(document).ready(function() {
    $('#product_name').on('input', function() {
        var charCount = $(this).val().length;
        $('#char_count').text(charCount + '/32');
        product_name = $(this).val()
    });



});
</script>
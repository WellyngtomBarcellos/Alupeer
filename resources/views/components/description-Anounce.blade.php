<div id="Description_Selection">
    <div class="header-desc">
        <h1>Vamos descrever seu produto!</h1>
        <p>Diga como está o estado de conservação e algumas informações que serão relevante para <br>
            quem está alugando seu produto, quanto mais informação melhor!
        </p>
    </div>

    <textarea name="" id="product_desc" placeholder="Descreva seu Produto" maxlength="255"></textarea>
    <span class="charcount">0/255</span>

    <div id="next_step_two" onclick="steper_step()"><span>Próximo</span></div>
</div>

<script>
$(document).ready(function() {
    $('#product_desc').on('input', function() {
        var charCount = $(this).val().length;
        $('.charcount').text(charCount + '/255');
        description = $(this).val()
    });
});
</script>
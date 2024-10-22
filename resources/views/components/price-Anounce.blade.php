<div id="Price_Selection">

    <h1>Por quanto você quer Alugar?</h1>
    <p>Esse valor é por dia, então seja Justo na sua precificação 😁</p>

    <div class="priceContainer">
        <label for="">R$</label>
        <input type="number" id="price_input" value="100">
    </div>

    <div class="tax">
        <div class="resum">
            <div class="sider">
                <p>Preço Sugerido:</p>
                <p class="price">R$100</p>
            </div>
            <div class="sider">
                <p>Taxa de aluguel:</p>
                <p class="rental-fee">R$14</p>
            </div>
        </div>
        <hr>
        <div class="earn">
            <div class="sider">
                <p>Você Receberá:</p>
                <p class="earnings">R$86</p>
            </div>
        </div>
    </div>
    <div id="next_step_two" onclick="quint_step()"><span>Próximo</span></div>
</div>

<script>
$(document).ready(function() {
    $('#price_input').on('input', function() {
        var price = parseFloat($(this).val());

        if (isNaN(price) || price <= 0) {
            price = 0;
        }

        var rentalFee = price * 0.05; // Supondo que a taxa de aluguel é 14% do preço
        var earnings = price - rentalFee;

        $('.price').text('R$' + price.toFixed(2));
        $('.rental-fee').text('R$' + rentalFee.toFixed(2));
        $('.earnings').text('R$' + earnings.toFixed(2));
    });
});
</script>
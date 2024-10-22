<div id="Float_Selection">
    <h1>Vamos começar com algo rápido!</h1>
    <h3>Qual o estado de Degradação do seu item ?</h3>

    <div class="float_container">

        <div class="float_option">
            <div class="checkbox-wrapper-11">
                <input id="02-11" type="radio" name="usage" value="Novo">
                <label for="02-11">Produto novo (menos de 2 meses de Uso)</label>
            </div>

            <div class="checkbox-wrapper-11">
                <input id="02-12" type="radio" name="usage" value="Semi">
                <label for="02-12">Pouco Usado (menos de 3 meses de Uso)</label>
            </div>

            <div class="checkbox-wrapper-11">
                <input id="02-13" type="radio" name="usage" value="Usado">
                <label for="02-13">Usado (Menos de 1 Ano de Uso)</label>
            </div>

            <div class="checkbox-wrapper-11">
                <input id="02-14" type="radio" name="usage" value="Desgastado">
                <label for="02-14">Desgastado (Mais de 1 Ano de Uso)</label>
            </div>
        </div>

        <div class="float_selected">
            👀
        </div>

    </div>
</div>

<script>
$('.checkbox-wrapper-11 input[type="radio"]').change(function() {
    if ($(this).is(':checked')) {
        float = $(this).val()
        var floatClass = $('.float_selected')
        floatClass.html('')

        const floatMessages = {
            'Novo': {
                title: "Uaau que incrível, um Produto Novo pode ser alugado por mais vezes, portanto poderá receber uma renda maior no aluguel!",
                text: "Sendo assim deixa de Papo e vamos continuar!"
            },
            'Semi': {
                title: "Show de bola, um produto Semi-Novo é perfeito para alugar!",
                text: "Vamos para a próxima etapa?"
            },
            'Usado': {
                title: "Se está usado é porque fez um bom trabalho, mas garanto que aguenta mais um pouquinho",
                text: "Bora para a próxima!"
            },
            'Desgastado': {
                title: "Eita..., Um produto Desgastado pode sofrer mais danos durante o uso!",
                text: "Entende que o item pode sofrer danos irreversíveis?"
            }
        };

        if (floatMessages.hasOwnProperty(float)) {
            const {
                title,
                text
            } = floatMessages[float];

            floatClass.html(`
                    <h3>"${title}"</h3>
                    <p>${text}</p> <br><br>
                    <div id="next_step_two" onclick="next_step()"><span>Próximo</span></div>
                `);
        }
    }
});
</script>
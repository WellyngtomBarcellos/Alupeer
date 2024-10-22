<div class="rating">
    <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
    <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
    <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
    <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
    <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
</div>

<style>
.rating {
    display: inline-block;
    unicode-bidi: bidi-override;
    direction: rtl;
}

.rating input {
    display: none;
}

.rating label {
    float: right;
    cursor: pointer;
    color: #ccc;
}

.rating label:before {
    content: '\2605';
    font-size: 24px;
}

.rating input:checked~label,
.rating input:checked~label~label {
    color: #f39c12;
}
</style>

<script>
// Exemplo de captura do valor selecionado
const ratings = document.getElementsByName('rating');
let ratingValue;

for (let i = 0; i < ratings.length; i++) {
    if (ratings[i].checked) {
        ratingValue = ratings[i].value;
        break;
    }
}

console.log('Rating selecionado:', ratingValue);
</script>
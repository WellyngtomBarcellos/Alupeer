<!-- resources/views/produto.blade.php -->

@php
// array de faixas
$ratingRanges = [

[0,0.9, '','Sem classificações para Exibir!','Não somos o Rotten Tomatoes'],
[1, 1.9, '<i class="fa-regular fa-face-tired rate_icon icon_poo"></i>', 'Hmm. não é dos melhores...', 'Os usuários não
recomendam <br> (Igual um Marea Turbo)'],

[2, 2.9, '<i class="fa-solid fa-thumbs-up rate_icon icon_half"></i>', 'Classificação Razoável', 'Poderia ser
melhor<br>(Igual o final FastX)'],

[3, 3.9, '<i class="fa-solid fa-star rate_icon icon_star"></i>', 'Show de bola...', 'Bem avaliado e uma boa
recomendação'],

[4, 4.9, '<img loading="lazy" src="https://i.ibb.co/DzPy9fY/2.webp" class="wheat wheat_top_four" alt=""><img
    src="https://i.ibb.co/DzPy9fY/2.webp" class="wheat wheat_bottom_four" alt="">', 'Top 10 anúncios Fodas',
'Classificações e grandes recomendações desse anúncio. <br>(Eles me amam! - Peter Parker)'],

[5, 5.1, '<img loading="lazy" src="https://i.ibb.co/VpTgQCq/4.webp" class="wheat wheat_top" alt=""><img
    src="https://i.ibb.co/VpTgQCq/4.webp" class="wheat wheat_bottom" alt="">', 'Meu Locador Preferido', 'Considerado
pelos usuários um anúncio <br> com bastantes avaliações positivas!'],
];

$ratingText = '';
$title = '';
$content = '';

// Encontre o ícone correspondente com base no valor do $rate
foreach ($ratingRanges as [$min, $max, $text, $t, $c]) {
if ($rate >= $min && $rate < $max) { $ratingText=$text; $title=$t; $content=$c; break; } } @endphp <div class="rate">
    {!! $ratingText !!}
    <p>{{ $rate }}</p>
    </div>

    @if ($title && $content)
    <div class="classification">
        <h2>{{ $title }}</h2>
        {!! $content !!}
    </div>





    @endif

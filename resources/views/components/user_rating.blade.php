<!-- resources/views/produto.blade.php -->

@php
// array de faixas
$ratingRanges = [

[1, 1.9, ''],

[2, 2.9, ''],

[3, 3.9, '<img loading="lazy" class="medal_5" title="Nível Prata | ('.$rate.') " src="https://i.ibb.co/XyKXRbF/diamond.webp" alt="">'],

[4, 4.9, '<img loading="lazy" class="medal_5" title="Nível Ouro| ('.$rate.') " src="https://i.ibb.co/RHPzqdP/gold.webp" alt="">'],

[5, 5.1, '<img loading="lazy" class="medal_5" title="Nível Diamante | ('.$rate.') "src="https://i.ibb.co/ZXvZBMw/platinun.webp" alt="">'],

];

$ratingText = '';
$title = '';
$content = '';

// Encontre o ícone correspondente com base no valor do $rate
foreach ($ratingRanges as [$min, $max, $text]) {
if ($rate >= $min && $rate < $max) { $ratingText=$text; break; } } @endphp <div {{$attributes}}>
    {!! $ratingText !!}
    </div>

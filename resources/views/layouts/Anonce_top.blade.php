<div id="anounce_Bar">

    <div class="side back_side">
        <span>Voltar</span>
    </div>
    <div class="side">
        <x-application-logo></x-application-logo>
    </div>

</div>

<script>
$('.back_side').on('click', function() {
    if (!is_editing) {
        window.location.href = "{{ route('home') }}";
    } else {
        var link = location.href
        window.location.href = link;
    }
})
</script>

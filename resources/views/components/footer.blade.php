<link rel="stylesheet" href="{{asset('css/footer/index.css')}}?v={{ time() }}">
<script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>
<footer>
    @if ($top)
    <div class="section">
        <div class="supor">
            <h3>Suporte</h3>
            <a href="/help"><span>Centro de Ajuda</span></a>
            <a href="https://lugator.tawk.help/article/como-anuncio-um-aluguel"><span>Como alugar</span></a>
        </div>

        <div class="anunce">
            <h3>Anúncios</h3>
            <a href="/locador"><span>Anuncie seu produto</span></a>
        </div>

        <div class="lugator">
            <h3>{{env('APP_NAME')}}</h3>
            <a href="/"><span>Trabalhe com a gente</span></a>
        </div>
    </div>
    @endif

    <div class="footer_container">

        <div class="side">
            <span>©2024 {{env('APP_NAME')}} LLC</span>
            <ul>
                <li><a href="/politicas-privacidade">•Termos</a></li>
                <li><a href="/politicas-privacidade">•Privacidade</a></li>
                <li><a href="/help">•Ajuda</a></li>
            </ul>
        </div>
        <div class="side">
            <a href="#" class="socials">
                <span><i class="fa-brands fa-instagram"></i></span>
            </a>
        </div>

    </div>
</footer>
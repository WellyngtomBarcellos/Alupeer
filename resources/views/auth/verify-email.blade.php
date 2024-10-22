<header>
    <title>Verifique seu Email</title>
</header>
<x-guest-layout>

    <div class="alerts">
        <h1>Quase lá! 🕵️‍♂️</h1>
        <span>Você está quase pronto para explorar o site! Só precisamos confirmar que você é realmente você. Enviamos
            um link para o seu email, é só clicar e pronto! <br><br>

            Se o e-mail não estiver na sua caixa de entrada, dê uma espiada no <strong>SPAM</strong> (às vezes ele
            se esconde por lá).<br><br>

            Confirme seu e-mail e aí você já vai poder aproveitar tudo que temos por aqui.<br><br> Valeu😛</span>

    </div>

    @if (session('status') == 'verification-link-sent')
    <span class="sended">
        {{ __('Enviado com sucesso') }}
    </span>
    @endif

    <div class="formes">
        <form class="formular" method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Ainda não recebi 🙂‍↔️') }}
                </x-primary-button>
            </div>
        </form>

        <form class="formulare" method="POST" action="{{ route('logout.verify') }}">
            @csrf

            <button type="submit" class="sende">
                {{ __('Sair') }}
            </button>
        </form>

    </div>
</x-guest-layout>

<style>
.alerts {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
    justify-content: center;
}

.alerts span {
    font-size: .9rem;
}

.formes {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.formulare {
    width: 100%;
}

.sended {
    font-size: .8rem;
    color: green;
}

.formular button {
    background: transparent;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 5px;
    text-decoration: underline;
    color: var(--colorBlack_);
}

.sende {
    padding: 10px;
    background: var(--blue);
    border: 1px solid var(--colorBlack);
    border-bottom: 5px solid var(--colorBlack);
    border-radius: 10px;
    color: var(--colorPrimary);
    font-weight: bold;
    cursor: pointer;


}
</style>
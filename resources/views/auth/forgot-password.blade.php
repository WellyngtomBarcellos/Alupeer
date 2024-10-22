<x-guest-layout>
    <div class="title_header">
        {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos por e-mail um link de redefinição de senha que permitirá que você escolha uma nova.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form">
            <div class="formula">
                <i class="fa-solid fa-envelope"></i>
                <x-text-input id="email" placeholder="Digite seu email" class="block mt-1 w-full" type="email"
                    name="email" :value="old('email')" required autofocus />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="inputer">
                {{ __('Enviar link de Recuperação') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
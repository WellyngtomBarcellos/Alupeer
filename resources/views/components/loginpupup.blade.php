<div class="container_loged">

    <div class="close">
        <i class="fa-solid fa-x" onclick="close_btn()"></i>
        <span>
            Login ou Sign up
        </span>
        <p></p>
    </div>

    <div class="ctn">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h3>Bem vindo ao {{env('APP_NAME')}}</h3>
        <div class="loginform">

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="combine">
                    <div class="input-mail inputse">
                        <i class="fa-solid fa-envelope"></i>
                        <x-text-input placeholder="Seu email" id="email" type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="input-senha inputse">
                        <i class="fa-solid fa-lock"></i>
                        <x-text-input placeholder="Sua senha" type="password" name="password" required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
                <div id="error-log">
                    <span>

                    </span>
                </div>

                <p class="politycs">Veja nossa Política de Privacidade para saber como protegemos seus dados. <a
                        href="{{route('politica')}}">Politica de privacidade</a> </p>

                <x-primary-button class="submit_bt">
                    {{ __('Entrar') }}
                </x-primary-button>

                <div class="google_login">

                    <p>ou</p>

                    <a href="{{ route('auth.google') }}" class="btn btn-primary">
                        <img loading="lazy" height="30px" src="{{asset('assets/googleicon.webp')}}" alt="">
                        <span>Continue com Google</span>
                    </a>
                </div>



                <p class="or">ou</p>
                <div class="misc">
                    @if (Route::has('password.request'))

                    <span class="clickreg">
                        {{ __('Registrar-se') }}
                    </span>

                    <a href="{{ route('password.request') }}">
                        {{ __('Equeci minha Senha') }}
                    </a>

                    @endif
                </div>
            </form>
        </div>


    </div>


    <div class="reg">
        <x-auth-session-status :status="session('status')" />

        <div class="loginform">
            <h3>Register</h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="combine">
                    <!-- Name -->
                    <div class="input-mail inputse">
                        <i class="fa-solid fa-signature"></i>
                        <x-text-input id="name" placeholder="Nome completo" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="input-mail inputse">
                        <i class="fa-solid fa-envelope"></i>
                        <x-text-input placeholder="Email" type="email" name="email" :value="old('email')" required
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="input-mail inputse">
                        <i class="fa-solid fa-lock"></i>
                        <x-text-input placeholder="Senha" type="password" name="password" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-mail inputse">
                        <i class="fa-solid fa-lock"></i>
                        <x-text-input placeholder="Confirma senha" id="password_confirmation" class="block mt-1 w-full"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <p class="politycs">Veja nossa Política de Privacidade para saber como protegemos seus dados. <a
                        href="#">Politica de privacidade</a> </p>

                <div class="google_login">
                    <a href="{{ route('auth.google') }}" class="btn btn-primary">
                        <img loading="lazy" height="30px" src="{{asset('assets/googleicon.webp')}}" alt="">
                        <span>Registre-se com Google</span>
                    </a>
                </div>

                <x-primary-button class="submit_bt">
                    {{ __('Bora nessa !') }}
                </x-primary-button>

                <div class="misc">
                    <span class="clicklog">
                        {{ __('já tenho conta') }}
                    </span>

                </div>
            </form>
        </div>


    </div>
</div>




<script>
function close_btn() {
    $('body').css('overflow', 'auto')
    var container_login = $('#Login')
    container_login.css('display', 'none')
};

$('.clicklog').on('click', function() {
    var ctn = $('.ctn')
    var reg = $('.reg')
    reg.css('display', 'none')
    ctn.css('display', 'block')
})
$('.clickreg').on('click', function() {
    var ctn = $('.ctn')
    var reg = $('.reg')
    reg.css('display', 'block')
    ctn.css('display', 'none')
})
</script>

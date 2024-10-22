<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="Registre-se em {{env('APP_NAME')}} ou liste itens facilmente. Experimente a nossa interface amigável e descubra uma ampla variedade de produtos disponíveis.">
    <meta name="keywords"
        content="registro, aluguel de produtos, plataforma de aluguel, alugar, listar itens, aluguel online">
    <meta name="author" content="{{env('APP_NAME')}}">
    <!-- Open Graph (para compartilhamento em redes sociais) -->
    <meta property="og:title" content="Registro na {{env('APP_NAME')}}">
    <meta property="og:description"
        content="Crie sua conta na {{env('APP_NAME')}} e comece a alugar ou listar itens de forma simples e rápida.">
    <meta property="og:image" content="{{ asset('assets/images/og-image.png') }}">
    <meta property="og:url" content="{{ url('/register') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{env('APP_NAME')}}">
    <!-- Twitter Card (para compartilhamento no Twitter) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Registro na {{env('APP_NAME')}}">
    <meta name="twitter:description"
        content="Crie sua conta na {{env('APP_NAME')}} e comece a alugar ou listar itens de forma simples e rápida.">
    <meta name="twitter:image" content="{{ asset('assets/images/twitter-card.png') }}">

    <!-- Link -->
    <link rel="stylesheet" href="{{asset('css/login/index.css')}}?v={{ time() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/site.webmanifest')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>


    <title>{{env('APP_NAME')}} | Register</title>
</head>


<body>
    <div class="back">
        <a href="/">Voltar</a>
    </div>
    <section>
        <div class="contianer">
            <img loading="lazy" src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/287cb2168310459.643814ca14a72.jpg" alt="">
        </div>
    </section>

    <section>
        <x-auth-session-status :status="session('status')" />

        <div class="loginform">
            <h1>Register</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="input-mail">
                    <i class="fa-solid fa-signature"></i>
                    <x-text-input id="name" placeholder="Nome completo" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="input-mail">
                    <i class="fa-solid fa-envelope"></i>
                    <x-text-input id="email" placeholder="Email" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="input-mail">
                    <i class="fa-solid fa-lock"></i>
                    <x-text-input id="password" placeholder="Senha" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="input-mail">
                    <i class="fa-solid fa-lock"></i>
                    <x-text-input placeholder="Confirma senha" id="password_confirmation" class="block mt-1 w-full"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="misc">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('Fazer login') }}
                    </a>

                </div>
                <x-primary-button class="submit">
                    {{ __('Bora nessa !') }}
                </x-primary-button>
            </form>
        </div>


    </section>

</body>




</html>

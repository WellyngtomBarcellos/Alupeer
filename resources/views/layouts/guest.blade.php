<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Metas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Links -->
    <link rel="stylesheet" href="{{asset('css/login/index.css')}}?v={{ time() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Script -->
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>

    <title>{{ config('app.name') }}</title>
</head>

<body class="">
    <div class="contain">
        <div class="container_reset">
            <div class="logobrabd">
                <a href="/">
                    <x-application-logo style="height: 30px;" />
                </a>
            </div>

            <div class="">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
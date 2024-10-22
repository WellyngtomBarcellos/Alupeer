<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Link-->
    <title>cordenadas</title>
</head>

<body>



    <script src="{{asset('js/geoposition.js')}}?v={{ time() }}"></script>
</body>

</html>
@php
$config = [
    'appName' => config('app.name')
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="{{ mix('js/app.js') }}" defer></script>

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app"></div>

        <script>
            window.config = @json($config);
        </script>
    </body>
</html>

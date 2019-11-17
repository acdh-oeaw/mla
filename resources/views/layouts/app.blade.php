<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"></meta>
        <meta name="viewport" content="width=device-width,initial-scale=1"></meta>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}"></style>
    </head>
    <body>
        <div id="app"></div>
        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>

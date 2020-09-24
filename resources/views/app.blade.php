<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="MailerLite" />
        <meta content="Danial Hayati" name="author" />

        <title>MailerLite Test Application</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ url('/').'/favicon.ico' }}" type="image/x-icon">

        <!-- Fonts -->
        {{--<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">--}}

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    </head>
    <body>
        <div id="app">
            <App
                :input_object_accounts='@json($accounts)'
                input_api_assets="{{ asset('/') }}"
                input_api_dashboard="{{ route('dashboard') }}"
                input_api_currencies="{{ route('currencies') }}"
            ></App>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

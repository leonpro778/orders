<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />

    <!-- own css styles -->
    <link rel="stylesheet" href="{{ asset('css/main-styles.css') }}" />
</head>
<body>
    <div class="container-fluid">
        <div class="col-12 text-right config-row">
            <a href="{{ url('changeLanguage/pl') }}"><img src="{{ asset('images/lang/lang-pl.png') }}" title="{{ __('layout_page.flag_pl') }}" /> PL</a> /
            <a href="{{ url('changeLanguage/en') }}"><img src="{{ asset('images/lang/lang-gb.png') }}" title="{{ __('layout_page.flag_en') }}" /> EN</a>
        </div>
    </div>

    <div class="container">
        @include('auth.main_menu')
        <br />
        @yield('content')
    </div>
    <hr />

    @include('layout.about_window')
</body>
</html>


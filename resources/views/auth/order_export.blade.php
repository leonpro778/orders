<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- own css styles -->
    <link rel="stylesheet" href="{{ asset('css/print-page.css') }}" />
</head>
<body>
    <br /><br />
    <table style="border: 2px solid #000000; border-collapse: collapse;">
        <tr style="font-weight: bold;">
            <td style="width: 30px; border: 2px solid #000000;">Lp.</td>
            <td style="width: 250px; border: 2px solid #000000;">Nazwa materiału</td>
            <td style="width: 60px; border: 2px solid #000000;">Ilość</td>
        </tr>

        @php
        $lp = 1;
        @endphp

        @foreach($order->orderedItems as $item)
            <tr>
                <td style="width: 30px; border: 2px solid #000000;">{{ $lp }}</td>
                <td style="width: 250px; border: 2px solid #000000; text-align: left;">{{ $item->name }}</td>
                <td style="width: 60px; border: 2px solid #000000; text-align: left">{{ $item->quantity }} {{ $item->units->name }}</td>
            </tr>
            @php
                $lp++;
            @endphp
        @endforeach
    </table>

    <table style="border: 2px solid #000000; border-collapse: collapse;">
        <tr style="font-weight: bold;">
            <td style="width: 30px; border: 2px solid #ffffff;"></td>
            <td style="width: 250px; border: 2px solid #ffffff;"><strong>Ilość zamówionych pozycji</strong></td>
            <td style="width: 60px; border: 2px solid #ffffff;"><strong>{{ count($order->orderedItems) }}</strong></td>
        </tr>
    </table>
</body>
</html>


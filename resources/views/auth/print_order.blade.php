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
    <div class="print-container">
        <div class="order-num">
            {{ __('print_order.print_order_number') }}
            <span class="text-size-up"><strong>{{ $order->number }}</strong></span>
        </div>

        <div class="order-date">
            {{ __('print_order.print_order_date') }}
            <span class="text-size-up"><strong>{{ $order->order_date }}</strong></span>
        </div>

        <div style="clear: both;"></div>

        <hr />

        <div class="order-title">{{ __('print_order.print_order_title') }}</div>

        <div class="text-department-title">{{ __('print_order.print_order_department') }}:</div>
        <div class="text-department">{{ $order->departments->name }}</div>

        <div class="order-action">{{ __('print_order.print_order_action') }}</div>

        <div class="order-table-container">
            <table class="table-order">
                <thead>
                    <tr class="table-header">
                        <th style="width: 30px;">{{ __('print_order.print_order_no') }}</th>
                        <th style="width: 250px;">{{ __('print_order.print_order_item_name') }}</th>
                        <th style="width: 60px;">{{ __('print_order.print_order_item_quantity') }}</th>
                        <th style="width: 60px;">{{ __('print_order.print_order_item_price') }}</th>
                        <th style="width: 150px;">{{ __('print_order.print_order_item_building') }}</th>
                        <th style="width: 120px;">{{ __('print_order.print_order_item_sum_price') }}</th>
                    </tr>
                </thead>
                <tbody>
                @php $no = 1; $sumPrice = 0; @endphp
                @foreach($order->orderedItems as $item)
                    <tr class="table-order-row-strip">
                        <td style="text-align: center;">{{ $no }}</td>
                        <td>{{ $item->name }}</td>
                        <td style="text-align: center;">{{ $item->quantity }} {{ $item->units->name }}</td>
                        <td style="padding-right: 10px; text-align: right;">{{ displayCurrency($item->price) }} {{ config('app.currency') }}</td>
                        <td style="padding-left: 10px;">{{ $item->buildings->name }}</td>
                        <td style="padding-right: 10px; text-align: right;">{{ displayCurrency(($item->quantity*$item->price)) }} {{ config('app.currency') }}</td>
                    </tr>
                    @php $no++; $sumPrice += $item->quantity*$item->price; @endphp
                @endforeach
                </tbody>
            </table>

            <div class="number-items">{{ __('print_order.print_order_num_items') }}: <strong>{{ count($order->orderedItems) }}</strong></div>
            <div class="value-order">{{ __('print_order.print_order_value') }}: <strong>{{ displayCurrency($sumPrice) }} {{ config('app.currency') }}</strong></div>
            <br />

            <div class="signature">{{ __('print_order.print_order_sign_owner') }}</div>
            <div class="signature-field">..............................................</div>
            <br />

            @if ($extended)
                <div class="signature">{{ __('print_order.print_order_sign_manager') }}</div>
                <div class="signature-field">..............................................</div>
                <br />
            @endif

            <div class="signature">{{ __('print_order.print_order_consent') }}</div>
            <div class="signature-field">..............................................</div>
            <br />

        </div>

        <div class="footer-order">
            <hr />
            {{ config('app.name') }} version: {{ config('app.major').'.'.config('app.minor').'.'.config('app.patch') }}
        </div>
    </div>

    <script>
        window.onload = function () {
            window.print();
        }
    </script>
</body>
</html>


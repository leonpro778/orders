@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.list_orders_view_order') }}</h3>
            <a href="{{ url('order/Print/'.$order->id) }}" class="btn btn-primary" target=_blank><i class="fas fa-print"></i> {{ __('auth.order_view_print_order') }}</a>
            <a href="{{ url('order/Print/'.$order->id.'/ext') }}" class="btn btn-primary" target=_blank><i class="fas fa-print"></i> {{ __('auth.order_view_print_order_ext') }}</a>
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-2">{{ __('auth.orders_new_order_num') }}</div>
                <div class="col-10"><strong>{{ $order->number }}</strong></div>
            </div>

            <div class="row">
                <div class="col-2">{{ __('auth.orders_new_order_department') }}</div>
                <div class="col-10"><strong>{{ $order->departments->name }}</strong></div>
            </div>

            <div class="row">
                <div class="col-2">{{ ucfirst(__('auth.list_orders_owner')) }}</div>
                <div class="col-10"><strong>{{ $order->owner->userDataGet->getFullName() }}</strong></div>
            </div>

            <div class="row">
                <div class="col-2">{{ ucfirst(__('auth.order_view_order_date')) }}</div>
                <div class="col-10"><strong>{{ $order->order_date }}</strong></div>
            </div>
            <br />

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">{{ __('auth.orders_new_order_item_name') }}</th>
                        <th scope="col" style="width: 70px;">{{ __('auth.orders_new_order_quantity') }}</th>
                        <th scope="col" style="width: 110px;">{{ __('auth.orders_new_order_price') }}</th>
                        <th scope="col">{{ __('auth.orders_new_order_building') }}</th>
                        <th scope="col">{{ __('auth.orders_new_order_contractor') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($order->orderedItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td style="text-align: center;">{{ $item->quantity }} {{ $item->units->name }}</td>
                        <td>{{ displayCurrency($item->price) }} {{ config('app.currency') }}</td>
                        <td>{{ $item->buildings->name }}</td>
                        <td>{{ $item->contractors->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


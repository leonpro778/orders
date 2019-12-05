@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.status_order_title') }}</h3>
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

            <form action="{{ url('order/updateStatus/'.$order->id) }}" method="POST">{{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="{{ __('auth.status_order_update_button') }}" /><br /><br />
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">{{ __('auth.orders_new_order_item_name') }}</th>
                        <th scope="col" style="width: 70px;">{{ __('auth.orders_new_order_quantity') }}</th>
                        <th scope="col" style="width: 110px;">{{ __('auth.orders_new_order_price') }}</th>
                        <th scope="col">{{ __('auth.status_order_status_item') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($order->orderedItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td style="text-align: center;">{{ $item->quantity }} {{ $item->units->name }}</td>
                        <td>{{ displayCurrency($item->price) }} {{ config('app.currency') }}</td>
                        <td>
                            <select name="item[{{ $item->id }}]" class="form-control custom-select-sm" style="color: #fff; background-color: {{ $item::getStatusProps($item->status)['statusColor'] }};">
                                @foreach($item::getStatusArray() as $status)
                                    @php $selected = $status == $item->status ? 'selected' : ''; @endphp
                                    <option value="{{ $status }}" {{ $selected }}>{{ $item::getStatusProps($status)['statusText'] }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </form>
        </div>
    </div>
@endsection


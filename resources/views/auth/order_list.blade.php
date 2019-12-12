@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.list_orders_title') }}</h3>
        </div>
    </div>

    <hr />
    <div class="row">
        <div class="col">
            <h4>{{ __('auth.search_title') }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="{{ url('search') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="col">{{ __('auth.search_order_by_date') }}</div>
                    <div class="col">
                        <select class="form-control form-control-sm" name="sort_type">
                            @if (session()->get('ls-conditions')['sort'] == 'desc')
                                <option value="desc" selected>{{ __('auth.search_sort_desc') }}</option>
                                <option value="asc">{{ __('auth.search_sort_asc') }}</option>
                            @else
                                <option value="desc">{{ __('auth.search_sort_desc') }}</option>
                                <option value="asc" selected>{{ __('auth.search_sort_asc') }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="col text-right">{{ __('auth.search_from_date') }}</div>
                    <div class="col"><input type="date" name="fromDate" class="form-control form-control-sm" value="{{ session()->get('ls-conditions')['date']['fromDate'] }}" /></div>

                    <div class="col text-right">{{ __('auth.search_to_date') }}</div>
                    <div class="col"><input type="date" name="toDate" class="form-control form-control-sm" value="{{ session()->get('ls-conditions')['date']['toDate'] }}" /></div>
                </div>
                <br />
                <div class="form-row">
                    <div class="col-2">Show order with status</div>
                    <div class="col-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="active" name="statusType[]" value="active" {{ session()->get('ls-conditions')['status_order']['active'] }}>
                            <label class="form-check-label" for="active">{{ __('auth.search_active_status') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="signed" name="statusType[]" value="signed" {{ session()->get('ls-conditions')['status_order']['signed'] }}>
                            <label class="form-check-label" for="signed">{{ __('auth.search_signed_status') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="closed" name="statusType[]" value="closed" {{ session()->get('ls-conditions')['status_order']['closed'] }}>
                            <label class="form-check-label" for="closed">{{ __('auth.search_closed_status') }}</label>
                        </div>
                    </div>
                </div>
                <br />
                <input type="submit" class="btn btn-primary" value="{{ __('auth.search_button_title') }}" />
            </form>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col text-center">
            <div style="display: inline-block;">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @foreach($orders as $order)
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                {{ __('auth.list_orders_order_number') }}: <strong>{{ $order->number }}</strong> |
                                {{ __('auth.list_orders_owner') }}: <strong>{{ $order->owner->userDataGet->getFullName() }}</strong> |
                                {{ __('auth.list_orders_order_value') }}: <strong>{{ displayCurrency($order->orderValue()) }} {{ config('app.currency') }}</strong>
                            </div>
                            <div class="col-2 text-right">
                                @if (Auth::user()->checkRole('operator') && ($order->status == $order::ACTIVE))
                                    <a href="{{ url('order/Sign/'.$order->id) }}" title="{{ __('auth.list_orders_sign_order') }}" onclick="return confirm('{{ __('auth.list_order_confirm_sign')  }}')"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ url('order/Delete/'.$order->id) }}" title="{{ __('auth.list_orders_delete') }}" onclick="return confirm('{{ __('auth.list_order_confirm_delete')  }}')"><i class="fas fa-trash-alt"></i></a>
                                @endif

                                @if ($order->status == $order::ACTIVE)
                                    <a href="{{ url('order/Edit/'.$order->id) }}" title="{{ __('auth.list_orders_edit') }}"><i class="fas fa-edit"></i></a>
                                @elseif (($order->status == $order::SIGNED) && (Auth::user()->checkRole('operator')))
                                    <a href="{{ url('order/Status/'.$order->id) }}" title="{{ __('auth.list_orders_change_status') }}"><i class="fas fa-exchange-alt"></i></a>
                                @endif
                                <a href="{{ url('order/View/'.$order->id) }}" title="{{ __('auth.list_orders_view_order') }}"><i class="far fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($order->orderedItems as $item)
                            <div class="row item-hover-row">
                                <div class="col-5">{{ $item->name }}</div>
                                <div class="col-2">{{ $item->quantity }} {{ $item->units->name }}</div>
                                <div class="col-2">{{ displayCurrency($item->quantity*$item->price) }} {{ config('app.currency') }}</div>
                                <div class="col-3">
                                    <span style="color: {{ $item::getStatusProps($item->status)['statusColor'] }};">
                                        <i class="{{ $item::getStatusProps($item->status)['statusIcon'] }}"></i> {{ $item::getStatusProps($item->status)['statusText'] }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                        <hr />
                            <span class="order-date-list">{{ $order->order_date }}</span>
                    </div>
                </div><hr />
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col text-center">
            <div style="display: inline-block;">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection


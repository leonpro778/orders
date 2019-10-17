@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.orders_result_title') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            {{ $order->number }}
        </div>
    </div>
@endsection


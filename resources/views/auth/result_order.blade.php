@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.orders_result_title') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            {{ __('auth.orders_result_success') }}: {{ $order->number }}<br /><br />
            <a href="{{ url('order/Edit/'.$order->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> {{ __('auth.orders_result_edit_button') }}</a>
            - {{ __('auth.orders_result_edit_text') }}<br /><br />

            <a href="{{ url('order/Sign/'.$order->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> {{ __('auth.orders_result_sign_button') }}</a>
            - {{ __('auth.orders_result_sign_text') }}<br /><br />

            <a href="{{ url('order/View/'.$order->id) }}" class="btn btn-primary"><i class="far fa-eye"></i> {{ __('auth.orders_result_view_button') }}</a>
            - {{ __('auth.orders_result_view_text') }}<br /><br />

            <a href="{{ url('order/List') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> {{ __('auth.orders_result_back') }}</a>
        </div>
    </div>
@endsection


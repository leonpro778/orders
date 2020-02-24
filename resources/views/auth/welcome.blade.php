@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.welcome') }} {{ $user->userDataGet->name }} {{ $user->userDataGet->surname }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('auth.quick_actions') }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ __('auth.quick_actions_describe') }}</h6>
                    <p class="card-text">
                        <a href="{{ url('order/New') }}" class="card-link"><i class="fas fa-folder-plus"></i> {{ __('auth.quick_actions_new_order') }}</a><br />
                        <a href="{{ url('order/List') }}" class="card-link"><i class="fas fa-list"></i> {{ __('auth.quick_actions_list_orders') }}</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('auth.my_orders') }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ __('auth.my_orders_describe') }}</h6>
                    <p class="card-text">
                        {{ __('auth.my_orders_7_days') }}: <strong>{{ count($orders) }}</strong><br />
                        ({{ count($ordersActive) }} {{ __('auth.my_orders_in_progress') }})<br />
                        <a href="{{ url('order/List') }}" class="card-link">{{ __('auth.my_orders_view_orders') }}</a><br /><br />
                    </p>
                </div>
            </div>
        </div>

        <div class="col col-md-4"></div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Chart title
                </div>

                <div class="card-body">
                    <div id="googleChartDiv"></div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{ asset('js/charts.js') }}"></script>
@endsection


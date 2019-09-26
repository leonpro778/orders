@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.welcome') }} {{ $user->userDataGet->name }} {{ $user->userDataGet->surname }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quick actions</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Shortcut's to quick actions</h6>
                    <p class="card-text">
                        <a href="#" class="card-link"><i class="fas fa-folder-plus"></i> New order</a><br />
                        <a href="#" class="card-link"><i class="fas fa-list"></i> List orders</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My orders</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Short summary of my orders</h6>
                    <p class="card-text">
                        Number of orders from last 7 days: <strong>0</strong><br />
                        (0 in progress)<br />
                        <a href="#" class="card-link">view orders</a><br /><br />

                        Number of orders from last 30 days: <strong>0</strong><br />
                        (0 in progress)<br />
                        <a href="#" class="card-link">view orders</a><br /><br />
                    </p>
                </div>
            </div>
        </div>

        <div class="col"></div>
    </div>
@endsection


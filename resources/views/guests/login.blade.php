@extends('layout.main_layout')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1>{{ config('app.name') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="card">
                <div class="card-header card-header-fill-blue">
                    {{ __('login_page.login_header') }}
                </div>
                <div class="card-body">
                    <form action="loginUser" method="POST">
                        <div class="form-group">
                            <label for="login">{{ __('login_page.label_login') }}</label>
                            <input type="text" class="form-control" name="login" id="login" value="{{ old('login') }}" />
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('login_page.label_password') }}</label>
                            <input type="password" class="form-control" name="password" id="password" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
@endsection


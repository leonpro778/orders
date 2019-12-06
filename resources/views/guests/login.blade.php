@extends('layout.main_layout')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col text-center">
            <h1>{{ config('app.name') }}</h1>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col- col-sm col-md-8 col-lg-4">
            <div class="card">
                <div class="card-header card-header-fill-blue">
                    {{ __('login_page.login_header') }}
                </div>
                <div class="card-body">
                    <form action="{{ url('loginUser') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="login">{{ __('login_page.label_login') }}</label>
                            <input type="text" class="form-control" name="login" id="login" value="{{ old('login') }}" />
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('login_page.label_password') }}</label>
                            <input type="password" class="form-control" name="password" id="password" />
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('login_page.login_button') }}</button>
                    </form>
                </div>
            </div>
            @if (session()->has('error'))
                <br />
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session()->get('error') }}
                </div>
            @endif
            @if (session()->has('success'))
                <br />
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>

@endsection


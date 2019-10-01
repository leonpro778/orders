@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.user_profile_password_title') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form action="{{ url('user/changePassword') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="current_password" class="col-4 col-form-label">{{ __('auth.user_profile_current_password') }}</label>
                    <div class="col-8">
                        <input type="password" class="form-control text-right" name="current_password" id="current_password" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new_password" class="col-4 col-form-label">{{ __('auth.user_profile_new_password') }}</label>
                    <div class="col-8">
                        <input type="password" class="form-control text-right" name="new_password" id="new_password" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="re_password" class="col-4 col-form-label">{{ __('auth.user_profile_re_password') }}</label>
                    <div class="col-8">
                        <input type="password" class="form-control text-right" name="re_password" id="re_password" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i> {{ __('auth.user_profile_password_button') }}</button>
            </form>
        </div>

        <div class="col">
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session()->get('error') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session()->get('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach ($errors->all() as $error)
                        {!! $error !!}<br />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

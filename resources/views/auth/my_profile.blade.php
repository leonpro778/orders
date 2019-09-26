@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.user_profile_title') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('auth.user_profile_login_title') }}</h5>
                    <div class="row">
                        <div class="col">{{ __('auth.user_profile_login') }}</div>
                        <div class="col font-weight-bold text-right">{{ $user->login }}</div>
                    </div>
                    <div class="row">
                        <div class="col">{{ __('auth.user_profile_password') }}</div>
                        <div class="col font-weight-bold text-right">********</div>
                    </div>
                    <div class="row">
                        <div class="col">{{ __('auth.user_profile_email') }}</div>
                        <div class="col font-weight-bold text-right">{{ $user->email }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4">{{ __('auth.user_profile_role') }}</div>
                        <div class="col-8 font-weight-bold text-right">{{ $user->getUserRole->getRoleName() }}</div>
                    </div>
                    <hr />
                    <p class="card-text">
                        {{ __('auth.user_profile_login_edit') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('auth.user_profile_data') }}</h5>
                    <div class="row">
                        <div class="col">{{ __('auth.user_profile_name') }}</div>
                        <div class="col font-weight-bold text-right">{{ $user->userDataGet->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col">{{ __('auth.user_profile_surname') }}</div>
                        <div class="col font-weight-bold text-right">{{ $user->userDataGet->surname }}</div>
                    </div>
                    <div class="row">
                        <div class="col">{{ __('auth.user_profile_department') }}</div>
                        <div class="col font-weight-bold text-right">{{ $user->userDataGet->getDepartment->getDepartmentName() }}</div>
                    </div>
                    <div class="row">
                        <div class="col">{{ __('auth.user_profile_phone') }}</div>
                        <div class="col font-weight-bold text-right">{{ $user->userDataGet->phone }}</div>
                    </div>
                    <div class="row">
                        <div class="col">{{ __('auth.user_profile_cellphone') }}</div>
                        <div class="col font-weight-bold text-right">{{ $user->userDataGet->cellphone }}</div>
                    </div>
                    <hr />
                    <p class="card-text">
                        <a href="{{ url('user/MyProfile/Edit') }}" class="card-link"><i class="fas fa-edit"></i> {{ __('auth.user_profile_edit') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection


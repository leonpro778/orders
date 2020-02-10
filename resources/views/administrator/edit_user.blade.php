@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.administrator_edit_user_title') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('auth.administrator_edit_user_card_title') }}</h5>
                    <form action="{{ url('administrator/UpdateUser/'.$user->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="role" class="col-4 col-form-label">{{ __('auth.user_profile_role') }}</label>
                                <div class="col-8">
                                    <select class="form-control text-right" name="role" id="role">
                                        @foreach ($userRole as $role)
                                            @if ((old('role') == $role->id) || ($user->role == $role->id))
                                                <option value="{{ $role->id }}" selected>{{ __('users_role.'.$role->name) }}</option>
                                            @else
                                                <option value="{{ $role->id }}">{{ __('users_role.'.$role->name) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-4 col-form-label">{{ __('auth.user_profile_email') }}:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-right" name="email" value="{{ $user->email }}" id="email" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-4 col-form-label">{{ __('auth.user_profile_name') }}:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-right" name="name" value="{{ $user->userDataGet->name }}" id="name" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="surname" class="col-4 col-form-label">{{ __('auth.user_profile_surname') }}:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-right" name="surname" value="{{ $user->userDataGet->surname }}" id="surname" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department" class="col-4 col-form-label">{{ __('auth.user_profile_department') }}</label>
                            <div class="col-8">
                                <select class="form-control text-right" name="department" id="department">
                                    @foreach ($departments as $department)
                                        @if ((old('department') == $department->id) || ($user->userDataGet->department == $department->id))
                                            <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                        @else
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-4 col-form-label">{{ __('auth.user_profile_phone') }}</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-right" name="phone" value="{{ $user->userDataGet->phone }}" id="phone" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cellphone" class="col-4 col-form-label">{{ __('auth.user_profile_cellphone') }}</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-right" name="cellphone" value="{{ $user->userDataGet->cellphone }}" id="cellphone" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> {{ __('auth.administrator_edit_user_update_button') }}</button>
                    </form><br />
                    <a href="{{ url('administrator/RestorePassword/'.$user->id) }}" class="btn btn-primary" title ="{{ __('auth.administrator_users_list_restore_password_button') }}" class="">
                        <i class="fas fa-unlock-alt"></i> {{ __('auth.administrator_users_list_restore_password_button') }}
                    </a>
                </div>
            </div>
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



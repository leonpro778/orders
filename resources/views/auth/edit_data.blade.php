@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.user_data_title') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form action="{{ url('user/MyProfile/Update') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">{{ __('auth.user_profile_name') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="name" value="{{ $user->userDataGet->name }}" id="name" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-4 col-form-label">{{ __('auth.user_profile_surname') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="surname" value="{{ $user->userDataGet->surname }}" id="surname" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="department" class="col-4 col-form-label">{{ __('auth.user_profile_department') }}</label>
                    <div class="col-8">
                        <select class="form-control text-right" name="department" id="department">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
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
                <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> {{ __('auth.user_data_update') }}</button>
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


@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.contractors_title') }}</h3>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <h5>{{ __('auth.contractors_edit_title') }}</h5>
            <form action="{{ url('contractors/Update/'.$contractor->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">{{ __('auth.contractors_contractor_name') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="name" id="name" value="{{ $contractor->name }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-4 col-form-label">{{ __('auth.contractors_contractor_address') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="address" id="address" value="{{ $contractor->address }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-4 col-form-label">{{ __('auth.contractors_contractor_email') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="email" id="email" value="{{ $contractor->email }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-4 col-form-label">{{ __('auth.contractors_contractor_phone') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="phone" id="phone" value="{{ $contractor->phone }}" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> {{ __('auth.contractors_update_button') }}</button>
            </form>
        </div>
    </div>
@endsection

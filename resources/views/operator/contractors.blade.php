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
            <h5>{{ __('auth.contractors_new_contractor') }}</h5>
            <form action="{{ url('contractors/AddContractor') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">{{ __('auth.contractors_contractor_name') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="name" id="name" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-4 col-form-label">{{ __('auth.contractors_contractor_address') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="address" id="address" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-4 col-form-label">{{ __('auth.contractors_contractor_email') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="email" id="email" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-4 col-form-label">{{ __('auth.contractors_contractor_phone') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="phone" id="phone" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-business-time"></i> {{ __('auth.contractors_new_contractor_add_button') }}</button>
            </form>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <h5>{{ __('auth.contractors_list') }}</h5>
            @foreach ($contractors as $contractor)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                {{ $contractor->name }}
                            </div>
                            <div class="col-3">
                                <a href="{{ url('contractors/Edit/'.$contractor->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> {{ __('auth.contractors_edit_button') }}
                                </a>
                            </div>
                            <div class="col-3">
                                @if ($contractor->id != 1)
                                    <a href="{{ url('contractors/Delete/'.$contractor->id) }}" class="btn btn-primary" title="{{ __('auth.contractors_delete_button') }}">
                                        <i class="far fa-trash-alt"></i> {{ __('auth.contractors_delete_button') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div><br />
            @endforeach
        </div>
    </div>
    @if (session()->has('success'))
        <hr />
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

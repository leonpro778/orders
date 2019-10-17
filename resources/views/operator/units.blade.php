@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.units_title') }}</h3>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <h5>{{ __('auth.units_new_type') }}</h5>
            <form action="{{ url('units/AddUnit') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">{{ __('auth.units_new_type_name') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="name" id="name" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-tachometer-alt"></i> {{ __('auth.units_new_type_add_button') }}</button>
            </form>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <h5>{{ __('auth.units_list') }}</h5>
            @foreach ($units as $unit)
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('units/Update/'.$unit->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-5">
                                    <input type="text" class="form-control" name="name" value="{{ $unit->name }}" />
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary" title="{{ __('auth.units_update_button') }}">
                                        <i class="fas fa-edit"></i> {{ __('auth.units_update_button') }}
                                    </button>
                                </div>
                                <div class="col-3">
                                    @if ($unit->id != 1)
                                        <a href="{{ url('units/Delete/'.$unit->id) }}" class="btn btn-primary" title="{{ __('auth.units_delete_button') }}">
                                        <i class="far fa-trash-alt"></i> {{ __('auth.units_delete_button') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
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



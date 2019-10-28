@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.buildings_title') }}</h3>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <h5>{{ __('auth.buildings_new_building') }}</h5>
            <form action="{{ url('buildings/AddBuilding') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">{{ __('auth.buildings_building_name') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="name" id="name" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="code" class="col-4 col-form-label">{{ __('auth.buildings_building_code') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="code" id="code" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-building"></i> {{ __('auth.buildings_new_building_add_button') }}</button>
            </form>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <h5>{{ __('auth.buildings_list') }}</h5>
            @foreach ($buildings as $building)
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('buildings/Update/'.$building->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" class="form-control" name="name" value="{{ $building->name }}" />
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" name="code" value="{{ $building->code }}" />
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary" title="{{ __('auth.buildings_update_button') }}">
                                        <i class="fas fa-edit"></i> {{ __('auth.buildings_update_button') }}
                                    </button>
                                </div>
                                <div class="col-3">
                                    @if ($building->id != 1)
                                        <a href="{{ url('buildings/Delete/'.$building->id) }}" class="btn btn-primary" title="{{ __('auth.buildings_delete_button') }}">
                                        <i class="far fa-trash-alt"></i> {{ __('auth.buildings_delete_button') }}
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



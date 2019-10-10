@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.administrator_departments_title') }}</h3>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <h5>{{ __('auth.administrator_departments_new') }}</h5>
            <form action="{{ url('administrator/AddDepartment') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">{{ __('auth.administrator_departments_name') }}</label>
                    <div class="col-8">
                        <input type="text" class="form-control text-right" name="name" id="name" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-location-arrow"></i> {{ __('auth.administrator_departments_add_button') }}</button>
            </form>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <h5>{{ __('auth.administrator_departments_list') }}</h5>
            @foreach ($departments as $department)
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('administrator/Departments/Update/'.$department->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-5">
                                    <input type="text" class="form-control" name="name" value="{{ $department->name }}" />
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary" title="{{ __('auth.administrator_departments_update') }}">
                                        <i class="fas fa-edit"></i> {{ __('auth.administrator_departments_update') }}
                                    </button>
                                </div>
                                <div class="col-3">
                                    @if ($department->id != 1)
                                    <a href="{{ url('administrator/Departments/Delete/'.$department->id) }}" class="btn btn-primary" title="{{ __('auth.administrator_departments_delete') }}">
                                        <i class="far fa-trash-alt"></i> {{ __('auth.administrator_departments_delete') }}
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



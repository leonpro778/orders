@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.administrator_users_list_title') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('auth.administrator_users_list_col_user_id') }}</th>
                        <th scope="col">{{ __('auth.administrator_users_list_col_name') }}</th>
                        <th scope="col">{{ __('auth.administrator_users_list_col_surname') }}</th>
                        <th scope="col">{{ __('auth.administrator_users_list_col_options') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->userDataGet->name }}</td>
                        <td>{{ $user->userDataGet->surname }}</td>
                        <td>
                            <a href="{{ url('administrator/EditUser/'.$user->id) }}" title ="{{ __('auth.administrator_users_list_edit_button') }}" class="">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="{{ url('administrator/RestorePassword/'.$user->id) }}" title ="{{ __('auth.administrator_users_list_restore_password_button') }}" class="">
                                <i class="fas fa-unlock-alt"></i>
                            </a>

                            <a href="{{ url('administrator/DeleteUser/'.$user->id) }}" title ="{{ __('auth.administrator_users_list_delete_user_button') }}" class="">
                                <i class="fas fa-user-minus"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection



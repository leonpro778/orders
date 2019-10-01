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
                        <th scope="col">ID user</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">edit</th>
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection



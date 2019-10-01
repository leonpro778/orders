<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\NewUserRequest;
use App\Models\Department;
use App\Models\User;
use App\Models\UserData;
use App\Models\UserRole;

class AdministratorController extends Controller
{
    public function newUser()
    {
        $data = [
            'userRole' => UserRole::where('id', '>', 1)->get(),
            'departments' => Department::all()
        ];
        return view('administrator.new_user')->with($data);
    }

    public function addUser(NewUserRequest $request)
    {
        $request->validated();

        try {
            $user = User::create(array_merge(['password' => bcrypt($request->password)], $request->except('password')));
            $userData = UserData::create(array_merge(['user_id' => $user->id], $request->all()));
        }
        catch (\Exception $e) {
            return redirect()->to('administrator/NewUser')
                ->withInput()
                ->with([
                    'error' => __('errors.database_update')
                ]);
        }

        return redirect()->to('administrator/NewUser')->with(['success' => __('auth.administrator_new_user_added_success')]);
    }

    public function usersList()
    {
        $data = [
            'users' => User::where('status', '<>', 5)->get()
        ];
        return view('administrator.users_list')->with($data);
    }
}

<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\NewUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Department;
use App\Models\User;
use App\Models\UserData;
use App\Models\UserRole;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function newUser()
    {
        $data = [
            'userRole' => UserRole::where('id', '>', 1)->get(),
            'departments' => Department::active()
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
            'users' => User::getAllUsers()
        ];
        return view('administrator.users_list')->with($data);
    }

    public function editUser($user_id)
    {
        try {
            $user = User::where('login', '<>', config('app.admin_login'))
                ->where('id', $user_id)
                ->firstorfail();

            $data = [
                'user' => $user,
                'userRole' => UserRole::where('id', '>', 1)->get(),
                'departments' => Department::active()
            ];

            return view('administrator.edit_user')->with($data);

        } catch (\Exception $e) {
            return redirect()->to('administrator/UsersList');
        }
    }

    public function updateUser(UpdateUserRequest $request, $user_id)
    {
        $request->validated();

        try {
            $user = User::where('login', '<>', config('app.admin_login'))
                ->where('id', $user_id)
                ->firstorfail();
            $userData = UserData::find($user_id);
            $user->update($request->all());
            $userData->update($request->all());

            return redirect()->to('administrator/EditUser/'.$user_id)->with(['success' => __('auth.administrator_edit_user_update')]);

        } catch (\Exception $e) {
            return redirect()->to('administrator/UsersList');
        }
    }

    public function restorePassword($userId)
    {
        try {
            $user = User::where('login', '<>', config('app.admin_login'))
                ->where('id', $userId)
                ->firstorfail();
            $user->password = bcrypt(config('app.default_password'));
            $user->save();
            return redirect()->to('administrator/EditUser/'.$userId)->with(['success' => __('auth.administrator_restore_password')]);
        } catch (\Exception $e) {
            return redirect()->to('administrator/UserList');
        }
    }

    public function departmentsList()
    {
        $data = [
            'departments' => Department::active()
        ];
        return view('administrator.departments')->with($data);
    }

    public function deleteDepartment($department_id)
    {
        $department = Department::where('id', $department_id)
            ->where('id', '>', 1)->firstorfail();
        $department->update(['status' => 5]);
        return redirect()->to('administrator/Departments');
    }

    public function addDepartment(Request $request)
    {
        Department::create(['name' => $request->name, 'status' => 1]);
        return redirect()->to('administrator/Departments');
    }

    public function updateDepartment(Request $request, $department_id)
    {
        $department = Department::find($department_id);
        $department->update(['name' => $request->name]);
        return redirect()->to('administrator/Departments')->with(['success' => __('auth.administrator_departments_updated')]);
    }
}

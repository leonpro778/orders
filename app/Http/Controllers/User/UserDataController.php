<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserDataRequest;
use App\Models\Department;
use App\Models\UserData;
use Illuminate\Support\Facades\Auth;

class UserDataController extends Controller
{
    public function editData()
    {
        $data = [
            'user' => Auth::user(),
            'departments' => Department::all()
        ];

        return view('auth.edit_data')->with($data);
    }

    public function updateData(UserDataRequest $request)
    {
        $request->validated();

        try {
            $userData = UserData::where('user_id', Auth::user()->id)->first();
            $userData->fill($request->all());
            $userData->save();
        }
        catch (\Exception $e) {
            // TODO - maybe store this exception in database as error log?
            return redirect()->to('user/MyProfile/Edit')
                ->withInput()
                ->with([
                    'error' => __('errors.database_update')
                ]);
        }

        return redirect()->to('user/MyProfile/Edit')->with(['success' => __('auth.user_data_update_success')]);
    }
}

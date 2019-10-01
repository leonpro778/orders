<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function welcomePage()
    {
        return view('auth.welcome')->with(['user' => Auth::user()]);
    }

    public function myProfile()
    {
        return view('auth.my_profile')->with(['user' => Auth::user()]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validated();

        if (Hash::check($request->current_password, Auth::user()->getAuthPassword()))
        {
            $user = User::find(Auth::user()->id);

            try {
                $user->password = bcrypt($request->new_password);
                $user->save();
            }
            catch (\Exception $e) {
                // TODO - maybe store this exception in database as error log?
                return redirect()->to('user/changePassword')
                    ->withInput()
                    ->with([
                        'error' => __('errors.database_update')
                    ]);
            }

            return redirect()->to('user/changePassword')->with(['success' => __('auth.user_profile_change_password')]);
        }

        return redirect()->to('user/changePassword')->with(['error' => __('auth.user_profile_bad_password')]);
    }
}

<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function welcomePage()
    {
        $orders = Order::where('user_id', Auth::user()->id)->where('order_date', '>=', (date('Y-m-d', time()-60*60*24*7)))->get();
        $data = [
            'user' => Auth::user(),
            'orders' => $orders->where('status', '<>', Order::DELETED),
            'ordersActive' => $orders->where('status', '<>', Order::CLOSED)->where('status', '<>', Order::DELETED)
        ];

        return view('auth.welcome')->with($data);
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

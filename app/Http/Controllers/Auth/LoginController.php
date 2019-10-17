<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        $credentials = array_merge($request->only('login', 'password'), ['status' => User::ACTIVE ]);
        if (Auth::attempt($credentials)) {
            return redirect()->to('welcome');
        }
        else
        {
            $returnStatus = User::where('login', $request->login)->first()->status;
            switch ($returnStatus) {
                case User::BLOCKED:
                    $returnMessage = __('login_page.account_blocked');
                    break;

                case User::DELETED:
                    $returnMessage = __('login_page.account_deleted');
                    break;

                default:
                    $returnMessage = __('login_page.login_incorrect');
                    break;
            }
            return redirect()->to('login')
                ->withInput()
                ->with([
                'error' => $returnMessage
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('login')->with([
            'success' => __('login_page.logout_success')
        ]);
    }
}

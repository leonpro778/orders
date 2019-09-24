<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
        $credentials = $request->only('login', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->to('welcome');
        }
        else
        {
            Input::flashOnly('login');
            return redirect()->to('login')->with([
                'error' => __('login_page.login_incorrect')
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

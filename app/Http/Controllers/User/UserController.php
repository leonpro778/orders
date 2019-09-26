<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}

<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Tokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'login' => $request->login,
            'password' => $request->password
        ];
        
        $status = false;
        $token = '';

        if (Auth::attempt($credentials)) {
            $token = Tokens::generateToken();
            Tokens::addTokenToDatabase(Auth::user()->id, $token);
            $status = true;
        }

        return response()->json([
            'status' => $status,
            'token' => $token
        ], 200, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }

    public function checkStatus(Request $request)
    {
        $status = false;
        if (Tokens::checkToken($request->token)) {
            $status = true;
        }

        return response()->json([
            'status' => $status
        ]);
    }

    public function getOrdersLast(Request $request)
    {
        return Order::orderBy('order_date', 'desc')->take(5)->get()->toJson();
    }
}

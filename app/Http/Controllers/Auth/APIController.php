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
        $credentials = $request->json()->all();

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
        ]);
    }

    public function checkStatus(Request $request)
    {
        $status = false;

        if (Tokens::checkToken($request->json()->get('token'))) {
            $status = true;
        }

        return response()->json([
            'status' => $status
        ]);
    }

    public function getOrders($fromDate, $toDate)
    {
        $response = [
            'status' => true,
            'orders' => []
        ];

        /*
        Template for orders array

        orders => [
            'name' => $order->number
        ]
        */
        $orders = Order::whereBetween('order_date', [$fromDate, $toDate])->orderBy('order_date', 'desc')->get();
        
        foreach ($orders as $order) {
            
            foreach ($order->orderedItems as $orderedItem) {
                $items[] = [
                    'name' => $orderedItem->name,
                    'quantity' => $orderedItem->quantity,
                    'unit' => $orderedItem->units->name
                ];
            }

            $response['orders'][] = ['num' => $order->number, 'items' => $items];
        }

        if (count($response['orders']) == 0) { $response['status'] = false; }
        return response()->json($response);
    }

    public function logout(Request $request)
    {
        Tokens::deleteToken($request->json()->get('token'));
        return response()->json([
            'status' => true
        ]);
    }
}

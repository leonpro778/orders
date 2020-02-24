<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Service\SmsApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsController extends Controller
{
    public function sendSms(Request $request)
    {
        $smsApi = new SmsApi();
        $message = '';
        foreach (Item::getSmsOrderList($request->idOrder) as $item)
        {
            $message .= $item['name'].' - '.$item['quantity'].PHP_EOL;
        }

        $apiResponse = $smsApi->sendSms(Auth::user()->userDataGet->cellphone, $message, true);
        return response()->json([$apiResponse]);
    }
}

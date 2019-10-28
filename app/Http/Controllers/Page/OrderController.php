<?php


namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Contractor;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function newOrder()
    {
        $data = [
            'buildings' => Building::getBuildingsList(),
            'contractors' => Contractor::getContractorsList(),
            'units' => Unit::getUnitsList()
        ];
        return view('auth.new_order')->with($data);
    }

    public function saveOrder(Request $request)
    {
        $order = new Order();
        $order->addOrder($request->order_date);
        Item::addItemsToOrder($request, $order->id);
        $data = [
            'order' => $order
        ];
        return view('auth.result_order')->with($data);
    }
}

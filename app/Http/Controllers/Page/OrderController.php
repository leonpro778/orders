<?php


namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderStatus;
use App\SearchHelper;
use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Contractor;
use App\Models\Unit;

class OrderController extends Controller
{
    public function newOrder()
    {
        $data = [
            'buildings' => Building::getBuildingsList(),
            'contractors' => Contractor::getContractorsList(),
            'units' => Unit::getUnitsList(),
            'departments' => Department::all(),
        ];
        return view('auth.new_order')->with($data);
    }

    public function saveOrder(Request $request)
    {
        $order = new Order();
        $order->addOrder($request);
        Item::addItemsToOrder($request, $order->id);
        $data = [
            'order' => $order
        ];
        return view('auth.result_order')->with($data);
    }

    public function updateOrder($order_id, Request $request)
    {
        $order = Order::findorfail($order_id);
        Item::removeOldOrderedItems($order_id);
        Item::addItemsToOrder($request, $order_id);

        $data = [
            'order' => $order
        ];
        return view('auth.result_order')->with($data);
    }

    public function search(Request $request)
    {
        SearchHelper::setDateRange($request->fromDate, $request->toDate);
        SearchHelper::setSortType($request->sort_type);
        return redirect()->to('searchResult');
    }

    public function searchResult()
    {
        return $this->listOrders();
    }

    public function showOrders()
    {
        SearchHelper::setDefaultConditions();
        return $this->listOrders();
    }

    public function listOrders()
    {

        $orders = Order::getOrdersList();
        $data = [
            'orders' => $orders->paginate(5),
            'orderStatus' => Order::ACTIVE,
        ];
        return view('auth.order_list')->with($data);
    }

    public function signOrder($order_id)
    {
        Order::signOrder($order_id);
        return redirect()->to('order/List');
    }

    public function editOrder($id)
    {
        $order = Order::findorfail($id);

        $data = [
            'order' => $order,
            'units' => Unit::getUnitsList(),
            'contractors' => Contractor::getContractorsList(),
            'buildings' => Building::getBuildingsList(),
            'departments' => Department::all(),
        ];
        return view('auth.edit_order')->with($data);
    }

    public function viewOrder($order_id)
    {
        $data = [
            'order' => Order::findorfail($order_id)
        ];
        return view('auth.view_order')->with($data);
    }

    public function printOrder($order_id, $extended = false)
    {
        $data = [
            'order' => Order::findorfail($order_id),
            'extended' => $extended
        ];
        return view('auth.print_order')->with($data);
    }

    public function statusOrder($order_id)
    {
        $data = [
            'order' => Order::findorfail($order_id),
        ];
        return view('operator.status_order')->with($data);
    }

    public function updateStatusOrder(Request $request, $order_id)
    {
        $order = Order::findorfail($order_id);
        Item::updateItemsStatus($request->get('item'));
        return redirect()->to('order/Status/'.$order->id);
    }
}

<?php


namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function lastMonths()
    {
        $data = [];
        $months = 3;

        for ($i = 0; $i<=$months; $i++)
        {
            $currentDate = new \DateTime('now');
            $currentDate->modify('-'.$i.' months');
            $startDate = $currentDate->modify('first day of this month')->format('Y-m-d');
            $endDate = $currentDate->modify('last day of this month')->format('Y-m-d');
            $monthName = date('F', strtotime($startDate));

            $sumNumber = 0;

            $orders = Order::whereBetween('order_date', [$startDate, $endDate])->get();
            foreach ($orders as $order)
            {
                $sumNumber += $order->orderValue();
            }
            $currentData = [
                'month' => $monthName,
                'number' => $sumNumber/100,
                'price' => displayCurrency($sumNumber).' zł'
            ];

            $data[$i] = $currentData;
        }

        return response()->json($data);
    }
}

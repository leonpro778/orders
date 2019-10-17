<?php


namespace App\Models;

use \DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'number', 'status'];
    public $timestamps = false;

    public function orderStatus()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'status');
    }

    /**
     * Return next order number from model:
     * $count - number of last order
     * $month - month (in two digits format) in which order was created
     * $year - same as month :)
     *
     * @param $orderDate
     * @return string
     * @throws \Exception
     */
    public static function getNextOrderNumber($orderDate): string
    {
        $orderDate = new DateTime($orderDate);
        $fromDate = $orderDate->modify('first day of this month')->format('Y-m-d');
        $toDate = $orderDate->modify('last day of this month')->format('Y-m-d');
        $count = Order::whereBetween('order_date', [$fromDate, $toDate])->count()+1;
        $month = $orderDate->format('m');
        $year = $orderDate->format('Y');

        return $count.'/'.$month.'/'.$year;
    }

    public function addOrder($orderDate): bool
    {
        try {
            $this->user_id = Auth::user()->id;
            $this->number = self::getNextOrderNumber($orderDate);
            $this->status = OrderStatus::where('name', 'active')->first()->id;
            $this->order_date = $orderDate;
            $this->save();
            return true;
        } catch (\Exception $e) {
            // TODO - add error handler (error log)
            abort(500);
        }
    }
}

<?php


namespace App\Models;

use App\SearchHelper;
use \DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'number', 'status', 'department'];
    public $timestamps = false;

    const TEMP = 1;
    const ACTIVE = 2;
    const SIGNED = 5;
    const CLOSED = 9;
    const DELETED = 10;

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
        $lastOrder = Order::whereBetween('order_date', [$fromDate, $toDate])->orderBy('id', 'desc')->first();
        if ($lastOrder) {
            $number = explode('/', $lastOrder->number);
            $count = $number[0]+1;
        }
        else {
            $count = 1;
        }

        $month = $orderDate->format('m');
        $year = $orderDate->format('Y');
        return $count.'/'.$month.'/'.$year;
    }

    public static function getStatusOrderNumber()
    {
        return [
            'temp' => Order::TEMP,
            'active' => Order::ACTIVE,
            'signed' => Order::SIGNED,
            'closed' => Order::CLOSED,
            'deleted' => Order::DELETED
        ];
    }

    public function addOrder($request)
    {
        try {
            $this->user_id = Auth::user()->id;
            $this->number = self::getNextOrderNumber($request->order_date);
            $this->status = self::ACTIVE;
            $this->order_date = $request->order_date;
            $this->department = $request->department;
            $this->save();
            return true;
        } catch (\Exception $e) {
            // TODO - add error handler (error log)
            echo $e->getMessage();
        }
    }

    public static function getOrdersList()
    {
        $searchConditions = SearchHelper::getConditions();
        if (!Auth::user()->checkRole('operator')) { $searchConditions['where'][] = ['user_id', '=', Auth::user()->id]; }

        $whereConditions = $searchConditions['where'];
        $whereInCondition = $searchConditions['wherein'];
        $dateRange = [$searchConditions['date']['fromDate'], $searchConditions['date']['toDate']];
        $sortType = $searchConditions['sort'];

        return Order::where($whereConditions)
            ->whereIn('status', $whereInCondition)
            ->whereBetween('order_date', $dateRange)
            ->orderBy('order_date', $sortType)
            ->orderBy('id', $sortType);
    }

    public function orderedItems()
    {
        return $this->hasMany(Item::class, 'order_id', 'id')->where('status', '<>', Item::DELETED);
    }

    public function departments()
    {
        return $this->hasOne(Department::class, 'id', 'department');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderValue()
    {
        $orderValue = 0;
        foreach($this->orderedItems as $item)
        {
            $orderValue += $item->price*$item->quantity;
        }
        return $orderValue;
    }

    public static function signOrder($order_id)
    {
        self::findorfail($order_id)->update(['status' => self::SIGNED]);
    }

    public static function deleteOrder($order_id)
    {
        self::findorfail($order_id)->update(['status' => self::DELETED]);
    }
}

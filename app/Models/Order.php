<?php


namespace App\Models;

use App\SearchHelper;
use \DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'number', 'status'];
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
        $count = Order::whereBetween('order_date', [$fromDate, $toDate])->count()+1;
        $month = $orderDate->format('m');
        $year = $orderDate->format('Y');

        return $count.'/'.$month.'/'.$year;
    }

    public function addOrder($request): bool
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
        if (!Auth::user()->checkRole('operator')) { $searchConditions[0]['where'][] = ['user_id', '=', Auth::user()->id]; }

        $whereConditions = $searchConditions[0]['where'];
        $dateRange = [$searchConditions[0]['date']['fromDate'], $searchConditions[0]['date']['toDate']];
        $sortType = $searchConditions[0]['sort']['order_date'];

        return Order::where($whereConditions)
            ->whereBetween('order_date', $dateRange)
            ->orderBy('order_date', $sortType);
    }

    public function orderedItems()
    {
        return $this->hasMany(Item::class, 'order_id', 'id');
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
}

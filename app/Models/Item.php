<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * Define items status
     */
    const ORDERED = 1;
    const NOT_ORDERED = 2;
    const DELIVERED = 3;
    const DELETED = 10;

    protected $table = 'ordered_items';
    public $timestamps = false;

    protected $fillable = [
        'order_id', 'name', 'quantity', 'unit', 'price', 'building', 'company', 'status'
    ];

    public function units()
    {
        return $this->hasOne(Unit::class, 'id', 'unit');
    }

    public function buildings()
    {
        return $this->hasOne(Building::class, 'id', 'building');
    }

    public function contractors()
    {
        return $this->hasOne(Contractor::class, 'id', 'contractor');
    }

    public static function addItemsToOrder($request, $order_id)
    {

        $items = $request->get('countItems');

        /**
         * Stored data to mass insert to database
         */
        $arrayData = [];

        foreach($items as $key => $n) {
            $arrayData[] = [
                'order_id' => $order_id,
                'name' => $request->get('itemName')[$key],
                'quantity' => $request->get('quantity')[$key],
                'unit' => $request->get('unit')[$key],
                'price' => changeCurrencyToInt($request->get('price')[$key]),
                'building' => $request->get('building')[$key],
                'contractor' => $request->get('contractor')[$key],
                'status' => self::NOT_ORDERED,
            ];
        }

        try {
            Item::insert($arrayData);
        } catch (\Exception $e) {
            // TODO - error handler + log
            Order::where('id', $order_id)->delete();
            abort(500);
        }
    }

    public static function removeOldOrderedItems($order_id)
    {
        Item::where('order_id', $order_id)->delete();
    }

    public static function getStatusProps($status)
    {
        switch ($status)
        {
            case self::ORDERED:
                $statusText = __('item_status.ordered');
                $statusColor = '#ff6600';
                $statusIcon = 'fas fa-hourglass-half';
                break;

            case self::NOT_ORDERED:
                $statusText = __('item_status.not_ordered');
                $statusColor = '#ff0000';
                $statusIcon = 'fas fa-times-circle';
                break;

            case self::DELIVERED:
                $statusText = __('item_status.delivered');
                $statusColor = '#00cc00';
                $statusIcon = 'fas fa-check-circle';
                break;

            default:
                $statusText = __('item_status.unknown');
                $statusColor = '#000000';
                $statusIcon= 'fas fa-question';
                break;
        }
        return [
            'statusText' => $statusText,
            'statusColor' => $statusColor,
            'statusIcon' => $statusIcon,
        ];
    }

    public static function getStatusName()
    {
        return [
            self::ORDERED => 'ordered',
            self::NOT_ORDERED => 'not_ordered',
            self::DELIVERED => 'delivered'
        ];
    }

    public static function getStatusArray()
    {
        return [self::ORDERED, self::NOT_ORDERED, self::DELIVERED];
    }

    public static function updateItemsStatus($items)
    {
        foreach ($items as $key => $value)
        {
            $item = self::find($key);
            $item->update(['status' => $value]);
        }
    }
}

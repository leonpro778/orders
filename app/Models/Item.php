<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'ordered_items';

    protected $fillable = [
        'order_id', 'name', 'quantity', 'unit', 'price', 'building', 'company', 'status'
    ];

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
                'status' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        try {
            Item::insert($arrayData);
        } catch (\Exception $e) {
            // TODO - error handler + log
            abort(500);
        }
    }
}

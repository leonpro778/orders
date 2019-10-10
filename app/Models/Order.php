<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id', 'number', 'status'];

    public function orderStatus()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'status');
    }
}

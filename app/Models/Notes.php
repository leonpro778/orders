<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table = 'notes';
    protected $fillable = ['order_id', 'user_id', 'text', 'status', 'created_at', 'updated_at'];

    public function getOrder()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function owner()
    {
        return $this->hasOne(UserData::class, 'id', 'user_id');
    }
}

<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    const ACTIVE = 1;
    const DELETED = 5;
    protected $table = 'units';

    protected $fillable = ['name', 'status'];

    public static function getUnitsList()
    {
        return self::where('status', self::ACTIVE)->get();
    }

    public static function deleteUnit($unit_id)
    {
        $unit = Unit::where('id', $unit_id)->where('id', '>', 1)->firstorfail();
        $unit->update(['status' => self::DELETED]);
    }
}

<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';

    public $timestamps = false;

    protected $fillable = ['name', 'status'];

    public static function getUnitsList()
    {
        return self::where('status', RecordStatus::ACTIVE)->get();
    }

    public static function deleteUnit($unit_id)
    {
        $unit = Unit::where('id', $unit_id)->where('id', '>', 1)->firstorfail();
        $unit->update(['status' => RecordStatus::DELETED]);
    }
}

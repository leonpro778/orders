<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'buildings';
    protected $fillable = ['name', 'code', 'status'];

    public static function getBuildingsList()
    {
        return self::where('status', RecordStatus::ACTIVE)->get();
    }

    public static function deleteBuilding($id)
    {
        $building = Building::where('id', $id)->where('id', '>', 1)->firstorfail();
        $building->update(['status' => RecordStatus::DELETED]);
    }
}

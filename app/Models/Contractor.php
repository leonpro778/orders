<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $table = 'contractors';

    protected $fillable = ['name', 'address', 'email', 'phone', 'status'];

    public static function getContractorsList()
    {
        return self::where('status', RecordStatus::ACTIVE)->get();
    }

    public static function deleteContractor($id)
    {
        $contractor = Contractor::where('id', $id)->where('id', '>', 1);
        $contractor->update(['status' => RecordStatus::DELETED]);
    }
}

<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = ['name', 'status'];

    public function users()
    {
        return $this->hasMany(User::class, 'departments', 'id');
    }

    public function getDepartmentName()
    {
        return $this->name;
    }

    public static function active()
    {
        return self::where('status', RecordStatus::ACTIVE)->get();
    }
}

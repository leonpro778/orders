<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    public function users()
    {
        return $this->hasMany(User::class, 'departments', 'id');
    }

    public function getDepartmentName()
    {
        return $this->name;
    }
}

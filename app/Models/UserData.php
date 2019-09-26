<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'users_data';

    protected $fillable = [
        'name', 'surname', 'department', 'phone', 'cellphone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::class, 'id', 'department');
    }
}

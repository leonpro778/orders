<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'users_role';

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'role');
    }

    public function getRoleName()
    {
        return __('users_role.'.$this->name);
    }
}

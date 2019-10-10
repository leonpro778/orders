<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'password', 'email', 'role', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * These values determine user account status.
     *
     * 5 - soft deleted
     * 1 - active
     * 2 - blocked
     */
    public const ACTIVE = 1;
    public const BLOCKED = 2;
    public const DELETED = 5;

    public function userDataGet()
    {
        return $this->hasOne(UserData::class, 'user_id', 'id');
    }

    public function getUserRole()
    {
        return $this->hasOne(UserRole::class, 'id', 'role');
    }

    public function checkRole($role)
    {
        if ($this->role <= UserRole::where('name', $role)->first()->id) { return true; }
    }

    public static function getAllUsers()
    {
        return self::where('status', '<>', 5)
            ->where('login', '<>', config('app.admin_login'))
            ->orderBy('role')
            ->get();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
}

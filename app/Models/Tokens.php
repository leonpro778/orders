<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tokens extends Model
{
    protected $table = 'tokens';
    public $fillable = ['user_id', 'token', 'expire', 'created_at', 'updated_at'];

    public static function addTokenToDatabase($userId, $token)
    {
        Tokens::where('user_id', $userId)->delete();

        Tokens::create([
            'user_id' => $userId,
            'token' => $token,
            'expire' => date('Y-m-d H:i', (time() + 60 + 60 + 24))
        ]);
    }

    public static function generateToken(int $lenght = 32)
    {
        return Str::random($lenght);
    }

    public static function checkToken($token)
    {
        $checkToken = Tokens::where('token', $token)
            ->where('expire', '>', date('Y-m-d H:i'))
            ->get()->count();
        if ($checkToken > 0) { return true; }
        else { return false; }
    }
}

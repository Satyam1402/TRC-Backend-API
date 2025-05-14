<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserToken extends Model
{
    protected $fillable = ['user_id', 'token', 'expires_at'];

    public static function generateToken($userId)
    {
        $token = Str::random(64);
        $expiresAt = now()->addHours(1); // Token valid for 1 hour

        return self::create([
            'user_id' => $userId,
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);
    }

    public static function validateToken($token)
    {
        $userToken = self::where('token', $token)
                         ->where('expires_at', '>', now())
                         ->first();

        return $userToken ? $userToken->user_id : null;
    }

    public static function deleteToken($token)
    {
        return self::where('token', $token)->delete();
    }
}

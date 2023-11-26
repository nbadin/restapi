<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone_number',
        'avatar',
    ];

    /**
     * Hook to save avatar
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if ($user->avatar) {
                $user->avatar = 'user/avatar/' . basename($user->avatar->store("user/avatar/", 'public'));
            }
        });

        static::updating(function ($user) {
            if ($user->avatar) {
                $user->avatar = 'user/avatar/' . basename($user->avatar->store("user/avatar/", 'public'));
            }
        });
    }
}

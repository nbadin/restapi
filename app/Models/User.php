<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
                $path = 'user/avatar/' . basename($user->avatar->store("user/avatar/", 'public'));
                $user->avatar = Storage::disk('public')->url($path);
            }
        });

        static::updating(function ($user) {
            if ($user->avatar) {
                $path = 'user/avatar/' . basename($user->avatar->store("user/avatar/", 'public'));
                $user->avatar = Storage::disk('public')->url($path);
            }
        });
    }
}

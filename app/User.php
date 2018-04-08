<?php

declare(strict_types=1);

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'registration_token', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'registration_token',
    ];

    /**
     * @param string $phone
     *
     * @return User|null
     */
    public static function findByRegistrationToken(string $token): ?self
    {
        return self::where('registration_token', $token)->first();
    }

    /**
     * @param string $phone
     *
     * @return User|null
     */
    public static function findByPhone(string $phone): ?self
    {
        return self::where('phone', $phone)->first();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    public static function createFromData(array $data): self
    {
        return self::create([
            'name'               => $data['name'],
            'phone'              => $data['phone'],
            'registration_token' => $data['token'],
            'password'           => Hash::make($data['password']),
        ]);
    }
}

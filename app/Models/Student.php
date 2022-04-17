<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The attributes mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'username',
        'sex',
        'email',
        'phone',
        'dob',
        'mob',
        'yob',
        'password',
        'is_active',
        'is_draft',
    ];

    /**
     * Set password for the user.
     *
     * @return array
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::needsRehash($password) ? \Hash::make($password) : $password;
    }

    /**
     * Routes notification for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }
}

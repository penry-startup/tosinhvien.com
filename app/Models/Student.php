<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
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
        'sex',
        'email',
        'phone',
        'password',
    ];
}

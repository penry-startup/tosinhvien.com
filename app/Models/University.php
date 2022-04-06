<?php

namespace App\Models;

class University extends BaseModel
{
    /**
     * The table used by the model.
     * @var string
     */
    protected $tabel = 'universities';

    /**
     * The attribute that are mass asignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'city_id',
        'type',
        'address',
        'phone',
        'website',
    ];
}

<?php

namespace App\Models;

class Subject extends BaseModel
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'subjects';

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];
}

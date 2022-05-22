<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends BaseModel
{
    use HasFactory;

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

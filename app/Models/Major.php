<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'majors';

    /**
     * The attribute mass assignable.
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'subject_group',
        'thpt_score',
        'hocba_score',
        'dgnl_score',
        'university_id'
    ];
}

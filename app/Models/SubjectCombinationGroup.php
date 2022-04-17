<?php

namespace App\Models;

class SubjectCombinationGroup extends BaseModel
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'subject_combination_groups';

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];
}

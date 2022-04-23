<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectCombinationGroup extends BaseModel
{
    use HasFactory;

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

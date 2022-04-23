<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectCombination extends BaseModel
{
    use HasFactory;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'subject_combinations';

    /**
     * The attribute that are mass assingable.
     * @var array
     */
    protected $fillable = [
        'name',
        'group_id',
    ];

    /**
     * Get the Subjects of the Group
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'group_subject', 'group_id');
    }

    /**
     * Get the group of the SubjectCombinationGroup
     */
    public function group()
    {
        return $this->belongsTo(SubjectCombinationGroup::class, 'group_id');
    }
}

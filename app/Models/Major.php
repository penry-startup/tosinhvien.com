<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Major extends BaseModel
{
    use HasFactory;

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

    /**
     * Get the University of the Major
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}

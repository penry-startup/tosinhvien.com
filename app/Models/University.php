<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends BaseModel
{
    use HasFactory;

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

    /**
     * Get the City of the University
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * The the Majors of the University
     */
    public function majors()
    {
        return $this->hasMany(Major::class);
    }
}

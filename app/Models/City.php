<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends BaseModel
{
    use HasFactory;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignble.
     * @var array
     */
    protected $fillable = [
        'code',
        'name'
    ];

    /**
     * Get the list Univerties of this City
     */
    public function universities()
    {
        return $this->hasMany(University::class);
    }
}

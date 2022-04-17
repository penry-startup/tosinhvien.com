<?php

namespace App\Student\Facades;

use Illuminate\Support\Facades\Facade;

class StudentFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'student';
    }
}

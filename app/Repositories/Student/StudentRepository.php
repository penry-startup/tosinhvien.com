<?php

namespace App\Repositories\Student;

use App\Repositories\EloquentRepository;

class StudentRepository extends EloquentRepository implements StudentRepositoryInterface
{
    public function model()
    {
        return \App\Models\Student::class;
    }
}

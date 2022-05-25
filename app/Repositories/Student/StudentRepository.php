<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;
use RuntimeException;

class StudentRepository extends EloquentRepository implements StudentRepositoryInterface
{
    public function model()
    {
        return \App\Models\Student::class;
    }

    public function queryList(Request $request)
    {
        $limit     = $request->get('limit', config('constants.pagination.limit'));
        $search    = $request->get('search', '');
        $orderBy   = $request->get('orderBy', '');
        $ascending = $request->get('ascending', '');

        $queryService = new QueryService($this->model);

        $queryService->select = ['*'];
        $queryService->columnSearch = [
            'name',
            'email',
            'phone',
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }

    public function randomeUsername(Student $student)
    {
        if ($student) {
            $hash = generate_random_string(8);
            return strtolower($student->name) . '.' . $student->id . $hash;
        } else {
            throw new RuntimeException('Student does not instanceof \App\Models\Student');
        }
    }
}

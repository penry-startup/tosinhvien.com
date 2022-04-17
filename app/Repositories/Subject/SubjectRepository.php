<?php
namespace App\Repositories\Subject;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class SubjectRepository extends EloquentRepository implements SubjectRepositoryInterface
{
    public function model()
    {
        return \App\Models\Subject::class;
    }

    public function list(Request $request)
    {
        $limit     = $request->get('limit', config('constants.pagination.limit'));
        $search    = $request->get('search', '');
        $orderBy   = $request->get('orderBy', '');
        $ascending = $request->get('ascending', '');

        $queryService = new QueryService($this->model);

        $queryService->select = ['*'];
        $queryService->columnSearch = [
            'name',
            'code',
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }
}

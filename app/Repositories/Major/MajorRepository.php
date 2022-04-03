<?php
namespace App\Repositories\Major;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class MajorRepository extends EloquentRepository implements MajorRepositoryInterface
{
    public function model()
    {
        return \App\Models\Major::class;
    }

    public function list(Request $request)
    {
        $limit     = $request->get('limit', config('constants.pagination.limit'));
        $search    = $request->get('search', '');
        $orderBy   = $request->get('orderBy', '');
        $ascending = $request->get('ascending', '');

        $builder = $this->model;
        $builder = $builder->leftJoin('universities', 'majors.university_id', '=', 'universities.id');
        $queryService = new QueryService($builder);

        $queryService->select = ['majors.*'];
        $queryService->columnSearch = [
            'majors.name',
            'majors.code',
            'majors.subject_group',
            'majors.thpt_score',
            'majors.hocba_score',
            'majors.dgnl_score',
            'universities.name',
            'universities.code',
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }
}

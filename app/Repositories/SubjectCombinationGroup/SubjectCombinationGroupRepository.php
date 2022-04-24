<?php
namespace App\Repositories\SubjectCombinationGroup;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class SubjectCombinationGroupRepository extends EloquentRepository implements SubjectCombinationGroupRepositoryInterface
{
    public function model()
    {
        return \App\Models\SubjectCombinationGroup::class;
    }

    public function store(Request $request)
    {
        $subjectCb = parent::store($request);
        $this->_syncSubjects($subjectCb, $request->input('subjects', []));

        return $subjectCb;
    }

    public function update(Request $request, $id)
    {
        $subjectCb = parent::update($request);
        $this->_syncSubjects($subjectCb, $request->input('subjects', []));

        return $subjectCb;
    }

    public function _syncSubjects($subjectCb, array $subjects)
    {
        return $subjectCb->subjects()->sync($subjects);
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
            'description',
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }
}

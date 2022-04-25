<?php
namespace App\Repositories\SubjectCombination;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class SubjectCombinationRepository extends EloquentRepository implements SubjectCombinationRepositoryInterface
{
    public function model()
    {
        return \App\Models\SubjectCombination::class;
    }

    public function store(Request $request)
    {
        $subjectCb = parent::store($request);
        $this->_syncSubjects($subjectCb, $request->input('subjects', []));

        return $subjectCb;
    }

    public function update(Request $request, $id)
    {
        $subjectCb = parent::update($request, $id);
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

        $builder = $this->model
                    ->leftJoin('subject_combination_groups', 'subject_combinations.group_id', '=', 'subject_combination_groups.id');

        $queryService = new QueryService($builder);

        $queryService->select  = ['subject_combinations.*'];
        $queryService->orderBy = 'subject_combinations.name';
        $queryService->columnSearch = [
            'subject_combinations.name',
            'subject_combination_groups.name',
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }
}

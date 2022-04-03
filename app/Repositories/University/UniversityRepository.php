<?php
namespace App\Repositories\University;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class UniversityRepository extends EloquentRepository implements UniversityRepositoryInterface
{
    public function model()
    {
        return \App\Models\University::class;
    }

    public function list(Request $request)
    {
        $limit     = $request->get('limit', config('constants.pagination.limit'));
        $search    = $request->get('search', '');
        $orderBy   = $request->get('orderBy', '');
        $ascending = $request->get('ascending', '');

        $builder = $this->model;
        $builder = $builder->leftJoin('cities', 'universities.city_id', '=', 'cities.id');
        $queryService = new QueryService($builder);

        $queryService->select = ['universities.*'];
        $queryService->columnSearch = [
            'universities.name',
            'universities.code',
            'universities.type',
            'universities.address',
            'universities.phone',
            'universities.website',
            'cities.name'
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }
}

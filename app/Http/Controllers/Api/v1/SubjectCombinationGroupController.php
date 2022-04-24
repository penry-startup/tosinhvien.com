<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\Admin\SubjectCombinationGroupRequest;
use App\Http\Resources\Admin\SubjectCombinationGroupResource;
use App\Repositories\SubjectCombinationGroup\SubjectCombinationGroupRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectCombinationGroupController extends Controller
{
    private $_subjectCombinationGroupRepo;

    public function __construct(SubjectCombinationGroupRepository $subjectCombinationGroupRepo)
    {
        $this->_subjectCombinationGroupRepo = $subjectCombinationGroupRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $subjectCombinationGroups = $this->_subjectCombinationGroupRepo->list($request);

            return $this->jsonTable([
                'data'  => SubjectCombinationGroupResource::collection($subjectCombinationGroups),
                'total' => ($subjectCombinationGroups->toArray())['total']
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        try {
            $subjectCombinationGroup = $this->_subjectCombinationGroupRepo->all(['id', 'name']);

            return $this->jsonData($subjectCombinationGroup);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectCombinationGroupRequest $request)
    {
        try {
            $subjectCombinationGroup = $this->_subjectCombinationGroupRepo->store($request);

            return $this->jsonData(new SubjectCombinationGroupResource($subjectCombinationGroup), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $subjectCombinationGroup = $this->_subjectCombinationGroupRepo->find($id);
            if (! empty($subjectCombinationGroup)) {
                return $this->jsonData(new SubjectCombinationGroupResource($subjectCombinationGroup));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectCombinationGroupRequest $request, $id)
    {
        try {
            $subjectCombinationGroup = $this->_subjectCombinationGroupRepo->update($request, $id);

            return $this->jsonData(new SubjectCombinationGroupResource($subjectCombinationGroup));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $subjectCombinationGroup = $this->_subjectCombinationGroupRepo->find($id);

            if ($subjectCombinationGroup) {
                $this->_subjectCombinationGroupRepo->destroy($id);
                return $this->jsonMessage(trans('messages.deleted'));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}

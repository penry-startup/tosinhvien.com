<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\Admin\SubjectCombinationRequest;
use App\Http\Resources\Admin\SubjectCombinationResource;
use App\Repositories\SubjectCombination\SubjectCombinationRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectCombinationController extends Controller
{
    private $_subjectCombinationRepo;

    public function __construct(SubjectCombinationRepository $subjectCombinationRepo)
    {
        $this->_subjectCombinationRepo = $subjectCombinationRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $subjectCombinations = $this->_subjectCombinationRepo->list($request);

            return $this->jsonTable([
                'data'  => SubjectCombinationResource::collection($subjectCombinations),
                'total' => ($subjectCombinations->toArray())['total']
            ]);
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
    public function store(SubjectCombinationRequest $request)
    {
        try {
            $subjectCombination = $this->_subjectCombinationRepo->store($request);

            return $this->jsonData(new SubjectCombinationResource($subjectCombination), Response::HTTP_CREATED);
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
            $subjectCombination = $this->_subjectCombinationRepo->find($id);
            if (! empty($subjectCombination)) {
                return $this->jsonData(new SubjectCombinationResource($subjectCombination));
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
    public function update(SubjectCombinationRequest $request, $id)
    {
        try {
            $subjectCombination = $this->_subjectCombinationRepo->update($request, $id);

            return $this->jsonData(new SubjectCombinationResource($subjectCombination));
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
            $subjectCombination = $this->_subjectCombinationRepo->find($id);

            if ($subjectCombination) {
                $this->_subjectCombinationRepo->destroy($id);
                return $this->jsonMessage(trans('messages.deleted'));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}

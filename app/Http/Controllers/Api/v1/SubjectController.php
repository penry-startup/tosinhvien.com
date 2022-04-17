<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\Admin\SubjectRequest;
use App\Http\Resources\Admin\SubjectResource;
use App\Repositories\Subject\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    private $_subjectRepo;

    public function __construct(SubjectRepository $subjectRepo)
    {
        $this->_subjectRepo = $subjectRepo;
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
            $subjects = $this->_subjectRepo->list($request);

            return $this->jsonTable([
                'data'  => SubjectResource::collection($subjects),
                'total' => ($subjects->toArray())['total']
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
    public function store(SubjectRequest $request)
    {
        try {
            $subject = $this->_subjectRepo->store($request);

            return $this->jsonData(new SubjectResource($subject), Response::HTTP_CREATED);
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
            $subject = $this->_subjectRepo->find($id);
            if (! empty($subject)) {
                return $this->jsonData(new SubjectResource($subject));
            }

            return $this->jsonMessage(trans('messages.not_found'), Response::HTTP_NOT_FOUND);
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
    public function update(SubjectRequest $request, $id)
    {
        try {
            $subject = $this->_subjectRepo->update($request, $id);

            return $this->jsonData(new SubjectResource($subject));
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
            $subject = $this->_subjectRepo->find($id);

            if ($subject) {
                $this->_subjectRepo->destroy($id);
                return $this->jsonMessage(trans('messages.deleted'));
            }

            return $this->jsonMessage(trans('messages.not_found'), Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}

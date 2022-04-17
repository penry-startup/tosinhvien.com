<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\Admin\StudentRequest;
use App\Http\Resources\Admin\StudentResource;
use App\Repositories\Student\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    private $_studentRepo;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->_studentRepo = $studentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $students = $this->_studentRepo->queryList($request);

            return $this->jsonTable([
                'data'  => StudentResource::collection($students),
                'total' => ($students->toArray())['total']
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
    public function store(StudentRequest $request)
    {
        try {
            $student = $this->_studentRepo->store($request);

            return $this->jsonData(new StudentResource($student), Response::HTTP_CREATED);
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
            $student = $this->_studentRepo->find($id);
            if (! empty($student)) {
                return $this->jsonData(new StudentResource($student));
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
    public function update(StudentRequest $request, $id)
    {
        try {
            $student = $this->_studentRepo->update($request, $id);

            return $this->jsonData(new StudentResource($student));
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
            $student = $this->_studentRepo->find($id);
            if ($student) {
                if ($student->is_draft === 1) {
                    $this->_studentRepo->destroy($id);
                    return $this->jsonMessage(trans('messages.deleted'));
                } else {
                    return $this->jsonMessage(trans('messages.cant_delete'));
                }
            }

            return $this->jsonMessage(trans('messages.not_found'), Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}

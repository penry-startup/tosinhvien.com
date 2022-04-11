<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\Admin\MajorRequest;
use App\Http\Resources\Admin\MajorResource;
use App\Repositories\Major\MajorRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MajorController extends Controller
{
    private $_majorRepo;

    public function __construct(MajorRepository $majorRepo)
    {
        $this->_majorRepo = $majorRepo;
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
            $majors = $this->_majorRepo->list($request);

            return $this->jsonTable([
                'data'  => MajorResource::collection($majors),
                'total' => ($majors->toArray())['total']
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
    public function store(MajorRequest $request)
    {
        try {
            $major = $this->_majorRepo->store($request);

            return $this->jsonData(new MajorResource($major), Response::HTTP_CREATED);
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
            $major = $this->_majorRepo->find($id);
            if (! empty($major)) {
                return $this->jsonData(new MajorResource($major));
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
    public function update(MajorRequest $request, $id)
    {
        try {
            $major = $this->_majorRepo->update($request, $id);

            return $this->jsonData(new MajorResource($major));
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
            $major = $this->_majorRepo->find($id);

            if ($major) {
                $this->_majorRepo->destroy($id);
                return $this->jsonMessage(trans('messages.deleted'));
            }

            return $this->jsonMessage(trans('messages.not_found'), Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}

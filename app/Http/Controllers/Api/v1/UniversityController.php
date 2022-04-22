<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\Admin\UniversityRequest;
use App\Http\Resources\Admin\UniversityResource;
use App\Repositories\University\UniversityRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UniversityController extends Controller
{
    private $_universityRepo;

    public function __construct(UniversityRepository $universityRepo)
    {
        $this->_universityRepo = $universityRepo;
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
            $universities = $this->_universityRepo->list($request);

            return $this->jsonTable([
                'data'  => UniversityResource::collection($universities),
                'total' => ($universities->toArray())['total']
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList()
    {
        try {
            $universities = $this->_universityRepo->all();

            return $this->jsonData($universities);
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
    public function store(UniversityRequest $request)
    {
        try {
            $university = $this->_universityRepo->store($request);

            return $this->jsonData(new UniversityResource($university), Response::HTTP_CREATED);
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
            $university = $this->_universityRepo->find($id);
            if (! empty($university)) {
                return $this->jsonData(new UniversityResource($university));
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
    public function update(UniversityRequest $request, $id)
    {
        try {
            $university = $this->_universityRepo->update($request, $id);

            return $this->jsonData(new UniversityResource($university));
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
            $university = $this->_universityRepo->find($id);

            if ($university) {
                $this->_universityRepo->destroy($id);
                return $this->jsonMessage(trans('messages.deleted'));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}

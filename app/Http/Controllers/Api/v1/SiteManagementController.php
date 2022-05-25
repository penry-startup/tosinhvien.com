<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\Admin\SiteManagementRequest;
use App\Http\Resources\Admin\SiteManagementResource;
use App\Repositories\SiteManagement\SiteManagementRepository;
use Illuminate\Http\Request;

class SiteManagementController extends Controller
{
    private $_siteManagementRepo;

    public function __construct(SiteManagementRepository $siteManagementRepo)
    {
        $this->_siteManagementRepo = $siteManagementRepo;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {
            $siteManagement = $this->_siteManagementRepo->find(1);

            return $this->jsonData(new SiteManagementResource($siteManagement));
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SiteManagementRequest $request)
    {
        try {
            $siteManagement = $this->_siteManagementRepo->update($request, 1);

            return $this->jsonData(new SiteManagementResource($siteManagement));
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function getListCity()
    {
        try {
            $cities = \App\Models\City::select('id', 'code', 'name')->get();

            return $this->jsonData($cities);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}

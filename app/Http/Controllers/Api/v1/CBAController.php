<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

class CBAController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke()
    {
        return view('CBA');
    }
}

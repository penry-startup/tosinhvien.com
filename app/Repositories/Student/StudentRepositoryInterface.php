<?php

namespace App\Repositories\Student;

use Illuminate\Http\Request;

interface StudentRepositoryInterface
{
    /**
     * Query resource by condition
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Pagination\LengthAwarePaginator;
     */
    public function queryList(Request $request);
}

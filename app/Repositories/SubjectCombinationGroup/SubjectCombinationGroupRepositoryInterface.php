<?php
namespace App\Repositories\SubjectCombinationGroup;

use Illuminate\Http\Request;

interface SubjectCombinationGroupRepositoryInterface
{
    public function list(Request $request);
}

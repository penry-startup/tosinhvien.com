<?php
namespace App\Repositories\SubjectCombination;

use Illuminate\Http\Request;

interface SubjectCombinationRepositoryInterface
{
    public function list(Request $request);
}

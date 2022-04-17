<?php
namespace App\Repositories\Subject;

use Illuminate\Http\Request;

interface SubjectRepositoryInterface
{
    public function list(Request $request);
}

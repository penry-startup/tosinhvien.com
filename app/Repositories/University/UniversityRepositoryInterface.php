<?php
namespace App\Repositories\University;

use Illuminate\Http\Request;

interface UniversityRepositoryInterface
{
    public function list(Request $request);
}

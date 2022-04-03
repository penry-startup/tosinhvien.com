<?php
namespace App\Repositories\Major;

use Illuminate\Http\Request;

interface MajorRepositoryInterface
{
    public function list(Request $request);
}

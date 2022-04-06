<?php
namespace App\Repositories\Student;

use Illuminate\Http\Request;

interface StudentRepositoryInterface
{
    public function list(Request $request);
}

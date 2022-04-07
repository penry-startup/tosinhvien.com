<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\Client\SignupRequest;
use App\Repositories\Student\StudentRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $_studentRepo;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->_studentRepo = $studentRepo;
    }

    /**
     * Show the form Signin
     *
     * @return \Illuminate\Http\Response
     */
    public function showSigninForm()
    {
        return view('client.auth.signin');
    }

    /**
     * Show the form Signup
     *
     * @return \Illuminate\Http\Response
     */
    public function showForgotPasswordForm()
    {
        return view('client.auth.forgot-password');
    }

    public function signup(SignupRequest $request)
    {
        try {
            \DB::beginTransaction();
            $student = $this->_studentRepo->store($request);
            if ($student) {
                \Auth::guard('student')->login($student);
                \DB::commit();
            }

            return redirect()->route('client.home.index');
        } catch (\Exception $e) {
            \DB::rollback();
            report($e);
        }
    }
}

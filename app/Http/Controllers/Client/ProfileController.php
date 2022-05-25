<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\Client\UpdateAvatarStudentRequest;
use App\Http\Requests\Validations\Client\UpdatePasswordStudentRequest;
use App\Http\Requests\Validations\Client\UpdateProfileStudentRequest;
use App\Repositories\Student\StudentRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $_studentRepo;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->_studentRepo = $studentRepo;
    }

    /**
     * Show profile detail of Student
     *
     * @param int $studentId
     * @return \Illuminate\Http\Response
     */
    public function profileDetail($username)
    {
        try {
            $student = $this->_studentRepo->findBy('username', $username);

            return view('client.profile.detail', compact('student'));
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Show form setting my profile of the Student
     *
     * @return \Illuminate\Http\Response
     */
    public function settingMyProfile()
    {
        try {
            $profileId = \StudentFacades::studentInfo('id');
            $profile   = $this->_studentRepo->find($profileId);

            return view('client.profile.my-setting', compact('profile'));
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Update Profile of the Student Auth
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UpdateProfileStudentRequest $request)
    {
        try {
            $studentId = \StudentFacades::studentInfo('id');
            $this->_studentRepo->update($request, $studentId);

            return redirect()->back()->with('update-profile', 'Cập nhật tài khoản thành công');
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Update Avatar of the Student Auth
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(UpdateAvatarStudentRequest $request)
    {
        try {
            $studentId = \StudentFacades::studentInfo('id');
            $this->_studentRepo->update($request, $studentId);

            return redirect()->back()->with('update-profile', 'Cập nhật ảnh đại diện thành công');
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Update Password of the Student Auth
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordStudentRequest $request)
    {
        try {
            $studentId = \StudentFacades::studentInfo('id');
            $this->_studentRepo->update($request, $studentId);

            return redirect()->back()->with('update-profile', 'Cập nhật mật khẩu thành công');
        } catch (\Exception $e) {
            report($e);
        }
    }
}

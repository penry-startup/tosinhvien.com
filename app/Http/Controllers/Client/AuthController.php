<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Repositories\Student\StudentRepository;
use App\Http\Requests\Validations\Client\SignupRequest;
use App\Notifications\Auth\SendVerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use ListHelper;

class AuthController extends Controller
{
    use AuthenticatesUsers;

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

    /**
     * Show the form Reset Password
     *
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function showFormResetPassword($token)
    {
        return view('client.auth.reset-password', compact('token'));
    }

    /**
     * Signup for Student
     *
     * @param Illuminate\Http\Request  $request;
     * @return \Illuminate\Http\Response
     */
    public function signup(SignupRequest $request)
    {
        try {
            \DB::beginTransaction();
            $student = $this->_studentRepo->store($request);

            $student->username = $this->_generateUsername($student);
            $student->avatar   = ListHelper::randomAvatar();
            $student->save();

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

    public function _generateUsername($student)
    {
        $hash = generate_random_string(8);
        return strtolower($student->name) . '.' . $student->id . $hash;
    }

    /**
     * Signup for Student
     *
     * @param Illuminate\Http\Request  $request;
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request)
    {
        try {
            $credential = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            $remember = (isset($request->remember) && $request->remember == 'on') ? true : false;
            if (\Auth::guard('student')->attempt($credential, $remember)) {
                try {
                    $prevURL = session(config('constants.session_keys.prev_route_authenticate'));
                    if ($prevURL) {
                        session()->forget(config('constants.session_keys.prev_route_authenticate'));
                        return redirect($prevURL)->with('loginSuccess', true);
                    }
                    return redirect()->route('client.home.index')->with('loginSuccess', true);
                } catch (\Throwable $th) {
                    return redirect(route('client.auth.showForm.login'));
                }
            } else {
                return redirect()->back()->withErrors(['credentials_incorrect' => trans('auth.credentials_incorrect')])
                ->withInput(['email' => $request->email]);
            }
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return \Auth::guard('student')->attempt(
            $request->only($this->username(), 'password'), $request->filled('remember')
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request)
    {
        try {
            $email = $request->email;
            $student = $this->_studentRepo->findBy('email', $email);
            if (! $student) {
                return redirect()->back()->withErrors(['email' => trans('auth.password_reset_user')]);
            }
            $passwordReset = PasswordReset::where(['email' => $email])->first();
            if (! $passwordReset) {
                $token = \Str::random(60);
                $passwordReset = (new PasswordReset)::insert([
                    'email' => $email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
            } else {
                $token = $passwordReset->token;
            }
            $url = url("/reset-password/{$token}");
            $student->notify(new SendVerificationEmail($url, $token));

            return redirect()->back()->with('send_mail_reset_pass_success', [
                'message' => trans('messages.sent_token_reset_pwd_success'),
                'email'   => $email,
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Reset Password for Student
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|password_valid|confirmed',
            ]);

            $passwordResetBuilder = PasswordReset::where('token', $request->_token_reset_pass);
            $passwordReset        = $passwordResetBuilder->first();
            if (
                Carbon::parse($passwordReset->created_at)->addMinutes(PasswordReset::EXPIRE_TOKEN)->isPast() ||
                !$passwordReset
            ) {
                return redirect()->back()->withErrors(['token' => trans('validation.token_valid')]);
            }
            $student           = $this->_studentRepo->findBy('email', $passwordReset->email);
            $student->password = $request->password;
            $student->save();
            $passwordResetBuilder->delete();

            return redirect()->back()->with('reset_pass_success', trans('auth.reset_password_successfully'));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function logout()
    {
        \Auth::guard('student')->logout();
        return redirect()->route('client.home.index');
    }
}

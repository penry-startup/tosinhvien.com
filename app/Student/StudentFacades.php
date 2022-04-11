<?php

namespace App\Student;

use Exception;

class StudentFacades
{
    const WELCOME_GUEST_NAME = 'Bạn';

    public static function guard()
    {
        return \Auth::guard('student');
    }

    /**
     * Check Student is Logged in
     *
     * @return bool
     */
    public static function isLogin()
    {
        return self::guard()->check();
    }

    /**
     * Get data of the Student if Logged in otherwise throw Exeption
     *
     * @param string $field?
     * @return array|Exception
     */
    public static function studentInfo($field = null)
    {
        if (self::isLogin()) {
            if ($field) {
                return self::guard()->user()->$field;
            }

            return self::guard()->user()->toArray();
        } else {
            throw new Exception('Student is not logged in so can\'t get data');
        }
    }

    /**
     * Get name of the student when visitor page
     *
     * @return string
     */
    public static function visitor()
    {
        if (self::isLogin()) {
            return ucfirst(self::studentInfo('name'));
        }

        return self::WELCOME_GUEST_NAME;
    }

    /**
     * Get joined data of student
     *
     * @return string
     */
    public function joined()
    {
        return 'Tham gia vào ' . format_date(self::studentInfo('created_at'), 'd/m/Y');
    }

    /**
     * Get student key
     */
    public function studentKey()
    {
        return self::studentInfo('username');
    }

    public function avatar()
    {
        return avatar_cute_path(self::studentInfo('avatar'));
    }
}

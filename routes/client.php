<?php
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'client.'], function() {
    // Auth
    Route::group(['as' => 'auth.'], function() {
        Route::get('/signin', 'Client\AuthController@showSigninForm')->name('showForm.signin');
        Route::get('/signup', 'Client\AuthController@showSinupForm')->name('showForm.signup');
        Route::get('/forgot-password', 'Client\AuthController@showForgotPasswordForm')->name('showForm.forgotPassword');
    });

    // Home Route
    Route::get('/', 'Client\HomeController@index')->name('home.index');

    // User Profile
    Route::group(['as' => 'user.'], function() {
        Route::get('/profile/{user}', 'Client\ProfileController@profileDetail')->name('profile.detail');
    });

    // Setting
    Route::group(['as' => 'settings.'], function() {
        Route::get('/settings/profile', 'Client\ProfileController@settingMyProfile')->name('profile.me.setting');
    });
});

<?php
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'client.'], function() {
    // Auth
    Route::group(['as' => 'auth.'], function() {
        Route::get('/signin', 'Client\AuthController@showSigninForm')->name('showForm.signin');
        Route::post('/signin', 'Client\AuthController@signin')->name('submit.signin');
        Route::post('/signup', 'Client\AuthController@signup')->name('submit.signup');
        Route::get('/forgot-password', 'Client\AuthController@showForgotPasswordForm')->name('showForm.forgotPassword');
        Route::post('/forgot-password', 'Client\AuthController@forgotPassword')->name('submit.forgotPassword');
        Route::get('/reset-password/{token}', 'Client\AuthController@showFormResetPassword')->name('showForm.resetPassword');
        Route::post('/reset-password', 'Client\AuthController@resetPassword')->name('submit.resetPassword');
        Route::get('/logout', 'Client\AuthController@logout')->name('submit.logout');
    });

    // Home Route
    Route::get('/', 'Client\HomeController@index')->name('home.index');

    Route::group(['middleware' => 'auth:student'], function() {
        // User Profile
        Route::group(['as' => 'user.'], function() {
            Route::get('/profile/{user}', 'Client\ProfileController@profileDetail')->name('profile.detail');
        });

        // Setting
        Route::group(['as' => 'settings.'], function() {
            Route::get('/settings/profile', 'Client\ProfileController@settingMyProfile')->name('profile.me.setting');
            Route::post('/settings/profile/update-profile', 'Client\ProfileController@updateProfile')->name('profile.me.update');
            Route::post('/settings/profile/update-avatar', 'Client\ProfileController@updateAvatar')->name('profile.me.updateAvatar');
            Route::post('/settings/profile/update-password', 'Client\ProfileController@updatePassword')->name('profile.me.updatePassword');
        });
    });
});

// Route::fallback('HomeController@index');

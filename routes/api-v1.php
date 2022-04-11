<?php

include('backend/Auth.php');
include('backend/Public.php');
include('backend/TestApi.php');

\Route::group(['middleware' => 'auth:api'], function() {

    // Vendor Routes
    \Route::group(['prefix' => 'vendor', 'as.' => 'vendor'], function() {
        include('backend/Merchant.php');
        include('backend/Shop.php');
    });

    // Admin Routes
    \Route::group(['prefix' => 'admin', 'as.' => 'admin'], function() {
        // CategoryGroup Routes
        \Route::apiResource('user', 'UserController');
        \Route::post('user/{user}/update-password', 'UserController@updatePassword')->name('user.updatePassword');
    });

    \Route::group(['prefix' => 'user', 'as.' => 'user.'], function() {
        // Student Routes
        \Route::apiResource('student', 'StudentController');
    });

    // Data Page Routes
    \Route::group(['prefix' => 'data-page', 'as' => 'data-page.'], function() {
        // University Routes
        \Route::apiResource('university', 'UniversityController');
        \Route::get('university/list/get-all', 'UniversityController@getList')->name('university.getList');

        // Major Routes
        \Route::apiResource('major', 'MajorController');
    });

    // Static Routes
    \Route::group(['prefix' => 'static', 'as' => 'static.'], function() {
        // University Routes
        \Route::get('list-city', 'StaticController@getListCity')->name('getListCity');
    });

    // Settings Routes
    \Route::group(['prefix' => 'settings', 'as' => 'settings'], function() {
        // Site Management Routes
        \Route::get('/site-management/show', 'SiteManagementController@show')->name('site_management.show');
        \Route::put('/site-management/update', 'SiteManagementController@update')->name('site_management.update');
    });
});

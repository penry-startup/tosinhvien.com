<?php

include('backend/Auth.php');
include('backend/TestApi.php');

\Route::group(['middleware' => 'auth:api'], function() {
    // Admin Routes
    \Route::group(['prefix' => 'admin', 'as.' => 'admin'], function() {
        // CategoryGroup Routes
        \Route::apiResource('user', 'UserController');
        \Route::post('user/{user}/update-password', 'UserController@updatePassword')->name('user.updatePassword');
    });

    \Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
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

        // Subject Routes
        \Route::apiResource('subject', 'SubjectController');
        \Route::get('subject/list/get-all', 'SubjectController@getAll')->name('subject.getAll');

        // Subject Combination Group Routes
        \Route::apiResource('subject-combination-group', 'SubjectCombinationGroupController');
        \Route::get('subject-combination-group/list/get-all', 'SubjectCombinationGroupController@getAll')->name('subject-combination-group.getAll');


        // SubjectCombination Routes
        \Route::apiResource('subject-combination', 'SubjectCombinationController');
    });

    // Static Routes
    \Route::group(['prefix' => 'static', 'as' => 'static.'], function() {
        // City Routes
        \Route::get('list-city', 'StaticController@getListCity')->name('getListCity');
    });

    // Settings Routes
    \Route::group(['prefix' => 'settings', 'as' => 'settings'], function() {
        // Site Management Routes
        \Route::get('/site-management/show', 'SiteManagementController@show')->name('site_management.show');
        \Route::put('/site-management/update', 'SiteManagementController@update')->name('site_management.update');
    });
});

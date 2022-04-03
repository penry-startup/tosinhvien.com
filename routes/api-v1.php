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
        //---- CategoryGroup Routes ----//
        \Route::apiResource('user', 'UserController');
        \Route::post('user/{user}/update-password', 'UserController@updatePassword')->name('user.updatePassword');
    });

    // Data Page Routes
    \Route::group(['prefix' => 'data-page', 'as' => 'data-page.'], function() {
        //---- University Routes ----//
        \Route::apiResource('university', 'UniversityController');
        \Route::get('university/list/get-all', 'UniversityController@getList')->name('university.getList');

        //---- Major Routes ----//
        \Route::apiResource('major', 'MajorController');
    });

    // Static Routes
    \Route::group(['prefix' => 'static', 'as' => 'static.'], function() {
        //---- University Routes ----//
        \Route::get('list-city', 'StaticController@getListCity')->name('getListCity');
    });
});

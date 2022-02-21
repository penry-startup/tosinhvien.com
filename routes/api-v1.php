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

});

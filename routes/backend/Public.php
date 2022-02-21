<?php

Route::group(['prefix' => 'public', 'as' => 'public.'], function() {
    // Location Public Api Routes
    Route::get('timezones', 'Public/LocationController@timezones')->name('timezones');
    Route::get('currencies', 'Public/LocationController@currencies')->name('currencies');
    Route::get('countries', 'Public/LocationController@countries')->name('countries');
    Route::get('states', 'Public/LocationController@states')->name('states');
});

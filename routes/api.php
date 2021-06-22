<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'AscendDigital\StorageManager\Http\Controllers'], function() {

    Route::group(['middleware' => ['api'], 'as' => 'api.', 'prefix' => 'api'], function() {
        Route::post('/utilities/file-upload', 'Api\FileUploadController@store')->name('utilities.file-upload.store');
        Route::delete('/utilities/file-upload', 'Api\FileUploadController@destroy')->name('utilities.file-upload.destroy');
    });
});

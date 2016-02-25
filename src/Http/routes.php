<?php
/**
 * User: pomir
 * Date: 2/24/2016
 * Time: 5:48 PM
 */

Route::group(['prefix' => '/elastic', 'as' => 'elastic.'], function () {
    Route::get('/', [
        'uses' => 'ElasticController@index',
        'as' => 'index'
    ]);
});

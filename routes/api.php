<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Api', 'as' => 'api.' ], function(){
    Route::resource('accounts', 'AccountsApiController', ['only' => ['index', 'store']]);
    Route::resource('staffs', 'StaffsApiController', ['only' => ['index', 'store']]);
});
<?php

Route::group(['namespace' => 'App\Components\Stubs\Admin'], function () {
    Route::resource('stubs', 'StubsController');
});

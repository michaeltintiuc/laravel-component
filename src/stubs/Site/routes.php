<?php

Route::group(['namespace' => 'App\Components\Stubs\Site'], function () {
    Route::resource('stubs', 'StubsController')->only(['index', 'show']);
});

<?php

// Route::any('/{all}', function () {
//     return view('welcome');
// })->where(['all' => '.*']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
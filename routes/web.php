<?php



Route::get('/', function () {
    return view('welcome');
});

Route::resource('locations', 'Locations');
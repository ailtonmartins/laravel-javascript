<?php

use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    return  response()->json(['message' => 'TodoBit API', 'status' => 'Connected']);
});

Route::resource('grupos', 'GruposController');
Route::resource('continentes', 'ContinentesController');
//Route::resource('times', 'TimesController');

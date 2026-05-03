<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'name' => 'Backend Carefund',
        'status' => 'OK',
        'message' => 'Service is up and running'
    ]);
});

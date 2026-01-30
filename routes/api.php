<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HallController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(HallController::class)->group(function () {
    Route::get('gethall' , 'gethall');
});
Route::get("vedio",function(){
    $vedio= public_path("vedio/hrr.mp4");
    return response()->file($vedio);
});

Route::controller(BookController::class)->group(function(){
    Route::post('createBook' , 'createBook');
});


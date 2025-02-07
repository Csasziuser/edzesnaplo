<?php

use App\Http\Controllers\BejegyzesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/edzesnaplo', [BejegyzesController::class, 'index'])->name('bejegyzes.index');
Route::post('/edzesnaplo', [BejegyzesController::class, 'store'])->name('bejegyzes.store');




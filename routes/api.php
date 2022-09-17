<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/readdir', [ \App\Http\Controllers\ApiController::class, 'readDir' ]);
Route::post('/download', [ \App\Http\Controllers\ApiController::class, 'download' ]);
Route::post('/unarchive', [ \App\Http\Controllers\ApiController::class, 'unacrhive' ]);
Route::post('/archive', [ \App\Http\Controllers\ApiController::class, 'archive' ]);
Route::post('/remove', [ \App\Http\Controllers\ApiController::class, 'remove' ]);
Route::post('/move', [ \App\Http\Controllers\ApiController::class, 'move' ]);
Route::post('/rename', [ \App\Http\Controllers\ApiController::class, 'rename' ]);
Route::post('/copy', [ \App\Http\Controllers\ApiController::class, 'copy' ]);
Route::post('/mkdir', [ \App\Http\Controllers\ApiController::class, 'mkdir' ]);
Route::post('/mkfile', [ \App\Http\Controllers\ApiController::class, 'mkfile' ]);
Route::post('/upload', [ \App\Http\Controllers\ApiController::class, 'upload' ]);

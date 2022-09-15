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
Route::get('/readdir', [ \App\Http\Controllers\ApiController::class, 'readDir' ]);
Route::get('/download', [ \App\Http\Controllers\ApiController::class, 'download' ]);
Route::get('/unarchive', [ \App\Http\Controllers\ApiController::class, 'unacrhive' ]);
Route::get('/archive', [ \App\Http\Controllers\ApiController::class, 'archive' ]);
Route::get('/remove', [ \App\Http\Controllers\ApiController::class, 'remove' ]);
Route::get('/move', [ \App\Http\Controllers\ApiController::class, 'move' ]);
Route::get('/rename', [ \App\Http\Controllers\ApiController::class, 'rename' ]);
Route::get('/copy', [ \App\Http\Controllers\ApiController::class, 'copy' ]);
Route::get('/mkdir', [ \App\Http\Controllers\ApiController::class, 'mkdir' ]);
Route::get('/mkfile', [ \App\Http\Controllers\ApiController::class, 'mkfile' ]);
Route::post('/upload', [ \App\Http\Controllers\ApiController::class, 'upload' ]);

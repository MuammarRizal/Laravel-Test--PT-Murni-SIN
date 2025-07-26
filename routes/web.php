<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.welcome');
});


Route::get('/', [MovieController::class,'index']);
Route::get('/movies',[MovieController::class,'movies']);
Route::get('/tv',[MovieController::class,'tv']);
Route::get('/search',[SearchController::class,'index']);
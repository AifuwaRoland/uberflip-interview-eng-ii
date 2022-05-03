<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// route to main page, calling the UniversityController to get data from db
Route::get('/', [UniversityController::class, 'getList']); 

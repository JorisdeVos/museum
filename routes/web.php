<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaintingController;

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
    return view('welcome');
});

Route::post('/save-image', [PaintingController::class, 'submitPainting']);
Route::get('/canvas', [PaintingController::class, 'showCanvas']);
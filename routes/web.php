<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagesController;
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

Route::get('/', function () {
    return view('pages.index');
});
Route::post('', [pagesController::Class,'input_table']);
Route::get('/school', [pagesController::Class,'school']);
Route::get('/pekob', [pagesController::Class,'pekob']);

// Route::get('/school', function () {
//     return view('pages.school');
// });

// Route::get('/pekob', function () {
//     return view('pages.pekob');
// });

// Route::get('/', [pagesController::Class,'home']);
// Route::view('input', 'pages.index');
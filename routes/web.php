<?php

use App\Http\Controllers\Admin\{
    BookController,
    MajorController,
    StudentController
};
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
    Route::view('dashboard', 'dashboard')->name('dashboard');

    /**
     * Administrator place
     */
    Route::middleware('can:isAdmin')->group(function() {
        Route::resource('students', StudentController::class);
        Route::resource('majors', MajorController::class);
        Route::resource('books', BookController::class);
        // Route::get('test', fn() => dd('ok'));
    });
    
    /**
     * Un-administrated plaace
     */
    Route::middleware('can:isNotAdmin')->group(function() {
        // Route::get('/test', fn() => dd('ok'));
    });

});


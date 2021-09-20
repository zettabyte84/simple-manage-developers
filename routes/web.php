<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin/settings
Route::middleware('auth')->group(function(){
    // Route::middleware('role:ROLE_CUSTOMER_SERVICE')->group(function(){

    // });

    // Profile
    Route::get('/developer/list', [App\Http\Controllers\DeveloperController::class, 'index'])->name('developers.list');
    Route::post('/profile/update', [App\Http\Controllers\UserController::class, 'profile_update'])->name('users.update');
    Route::get('/profile/change_password', [App\Http\Controllers\UserController::class, 'change_password'])->name('users.change_password');
    Route::post('/profile/update_password', [App\Http\Controllers\UserController::class, 'update_password'])->name('users.update_password');

    // Route::get('/developer/update', [App\Http\Controllers\DeveloperController::class, 'update'])->name('developers.update');
    // Route::get('/developer/insert', [App\Http\Controllers\DeveloperController::class, 'store'])->name('developers.insert');
    Route::get('/developer/destroy/{id}', [App\Http\Controllers\DeveloperController::class, 'destroy'])->name('developers.destroy');
    Route::get('/developer/bulkDelete', [App\Http\Controllers\DeveloperController::class, 'bulkDelete'])->name('developers.bulkDelete');


    Route::post('/developer/insert', [App\Http\Controllers\DeveloperController::class, 'store'])->name('developers.insert');
    Route::post('/developer/update', [App\Http\Controllers\DeveloperController::class, 'update'])->name('developers.update');
});

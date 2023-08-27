<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportCsvController;
use App\Http\Controllers\DetailFactureController;

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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::middleware(['auth', 'redirect.admin'])->group(function () {
//     Route::resource('admin', UserController::class);
// });

// Route::middleware(['auth', 'redirect.user'])->group(function () {

// });


// Route::resource('others', OtherController::class)->name('index', 'userhome');
Route::resource('admin', AdminController::class);

Route::resource('users', UserController::class);

Route::group(['middleware' => 'auth',
],
function(){
    // Gestion des utilisateurs
    Route::resource('admin', AdminController::class);
    Route::resource('users', UserController::class);

});
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActeController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\MedailleController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportcsvController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\NewdepenseController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::group(['middleware' => 'auth',
],
function(){
    // Gestion des utilisateurs
    Route::resource('admin', AdminController::class);
    Route::resource('users', UserController::class);

    // Gestion de chart
    Route::resource('chart', ChartController::class);

    // ADMIN
    // 1-Gestion des pays
    Route::resource('pays', PaysController::class);

    // Gestion de discipline
    Route::resource('disciplines', DisciplineController::class);

    // Gestion des athletes
    Route::resource('athletes', AthleteController::class);

    // Gestion des sites
    Route::resource('sites', SiteController::class);

    // 2- Gestion des depenses
    Route::resource('depenses', DepenseController::class);
    
    // Gestion des recettes
    Route::resource('recettes', RecetteController::class);

    // HANDLER
    // 1-Gestion des calendriers
    Route::resource('calendriers', CalendrierController::class);
    
    // Gesion des resultats finaux
    Route::resource('resultats', ResultatController::class);

    // 2- Gestion des nouvelles depenses et recettes
    Route::resource('newdepenses', NewdepenseController::class);
    Route::resource('newdepenses', NewdepenseController::class);

    Route::get('importCSV', [ImportcsvController::class, 'index'])->name('importindex');
    Route::post('importCSV', [ImportcsvController::class, 'importCSV'])->name('import');

});

// 1-GUEST
Route::resource('guests', GuestController::class);

// Calendar 
Route::resource('calendars', CalendarController::class);
Route::get('/results', [CalendarController::class, 'filterCalendar'])->name('calendars.filter');

// Tableau des medailles
Route::resource('medailles', MedailleController::class);

// 2-Dashboard
Route::resource('dashboard', DashboardController::class);

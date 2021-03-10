<?php

use App\Http\Controllers\FishermanTripController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IslandController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\FishermanController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ReportController;

// use App\Http\Controllers\HomeController;

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
// Route::get('/home', HomeController::class, 'index')->name('home');
Route::post('island/datatables', [IslandController::class, 'datatables'])->name('island.datatables');
Route::resource('/island', IslandController::class);
Route::post('species/datatables', [SpeciesController::class, 'datatables'])->name('species.datatables');
Route::resource('/species', SpeciesController::class);
Route::post('location/datatables', [LocationController::class, 'datatables'])->name('location.datatables');
Route::resource('/location', LocationController::class);
Route::post('method/datatables', [MethodController::class, 'datatables'])->name('method.datatables');
Route::resource('/method', MethodController::class);
Route::resource('/fisherman', FishermanController::class);
Route::resource('/island.fisherman', FishermanController::class);
Route::post('trip/datatables', [FishermanTripController::class, 'datatables'])->name('trip.datatables');
Route::resource('/trip', TripController::class);
Route::resource('/fisherman.trip', FishermanTripController::class);
Route::get('/export-excel', [FishermanTripController::class, 'ExportIntoExcel'])->name('export-excel');
Route::apiresource('/tripreport', ReportController::class);// I use apiresource to exclude other methods like edit and create

// Route::get('/Island', [App\Http\Controllers\IslandController::class, 'index'])->name('island.index');
// Route::post('/Island/create', [App\Http\Controllers\IslandController::class, 'create'])->name('island.create');
// Route::get('/species', [App\Http\Controllers\SpeciesController::class, 'index'])->name('species.index');
// Route::post('/Species/create', [App\Http\Controllers\SpeciesController::class, 'create'])->name('species.create');

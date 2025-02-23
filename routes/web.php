<?php

// use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CentrePointController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SpaceController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[App\Http\Controllers\MapController::class,'index'])->name('map.index');


Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\MapController::class, 'index'])->name('dashboard');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home',[App\Http\Controllers\MapController::class,'index'])->name('map.index');
Route::get('/map',[App\Http\Controllers\MapController::class,'index'])->name('map.index');
Route::get('/map/{slug}',[App\Http\Controllers\MapController::class,'show'])->name('map.show');



Route::prefix('admin')->group(function () {

    Route::get('/space/data',[DataController::class,'spaces'])->name('data-space');
    Route::get('space/create-polygon',[SpaceController::class,'createPolygon'])->name('space.create-polygon');
    Route::post('space/datatable', [SpaceController::class, 'datatable']);
    Route::resource('space',(SpaceController::class));

});

Route::resource('centre-point',(CentrePointController::class));
// Route::resource('category',(CategoryController::class));

Route::get('/centrepoint/data',[DataController::class,'centrepoint'])->name('centre-point.data');
// Route::get('/categories/data',[DataController::class,'categories'])->name('data-category');

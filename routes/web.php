<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KindController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AnimalController;

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


Route::group(['prefix' => 'kinds'], function(){
    Route::get('', [KindController::class, 'index'])->name('kind.index');
    Route::get('create', [KindController::class, 'create'])->name('kind.create');
    Route::post('store', [KindController::class, 'store'])->name('kind.store');
    Route::get('edit/{kind}', [KindController::class, 'edit'])->name('kind.edit');
    Route::post('update/{kind}', [KindController::class, 'update'])->name('kind.update');
    Route::post('delete/{kind}', [KindController::class, 'destroy'])->name('kind.destroy');
    Route::get('show/{kind}', [KindController::class, 'show'])->name('kind.show');
 });

 Route::group(['prefix' => 'managers'], function(){
    Route::get('', [ManagerController::class, 'index'])->name('manager.index');
    Route::get('create', [ManagerController::class, 'create'])->name('manager.create');
    Route::post('store', [ManagerController::class, 'store'])->name('manager.store');
    Route::get('edit/{manager}', [ManagerController::class, 'edit'])->name('manager.edit');
    Route::post('update/{manager}', [ManagerController::class, 'update'])->name('manager.update');
    Route::post('delete/{manager}', [ManagerController::class, 'destroy'])->name('manager.destroy');
    Route::get('show/{manager}', [ManagerController::class, 'show'])->name('manager.show');
 });

 Route::group(['prefix' => 'animals'], function(){
    Route::get('', [AnimalController::class, 'index'])->name('animal.index');
    Route::get('create', [AnimalController::class, 'create'])->name('animal.create');
    Route::post('store', [AnimalController::class, 'store'])->name('animal.store');
    Route::get('edit/{animal}', [AnimalController::class, 'edit'])->name('animal.edit');
    Route::post('update/{animal}', [AnimalController::class, 'update'])->name('animal.update');
    Route::post('delete/{animal}', [AnimalController::class, 'destroy'])->name('animal.destroy');
    Route::get('show/{animal}', [AnimalController::class, 'show'])->name('animal.show');
 });



 
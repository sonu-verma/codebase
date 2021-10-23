<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodesniptController;

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
   return redirect('/codesnipts');
});


Auth::routes();

Route::get('/codesnipts/{search?}', [App\Http\Controllers\CodesniptController::class,'codesnipts']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin','middleware' => 'auth'],function(){
   
    Route::get('/roles',[App\Http\Controllers\RoleController::class,'index'])->name('admin.roles'); 
    Route::get('/roles/add',[App\Http\Controllers\RoleController::class,'create'])->name('admin.roles.add');
    Route::post('/roles/save',[App\Http\Controllers\RoleController::class,'store'])->name('admin.roles.save');
    Route::get('/roles/delete/{id}',[App\Http\Controllers\RoleController::class,'destroy']);
    Route::get('/roles/edit/{id}',[App\Http\Controllers\RoleController::class,'edit'])->name('admin.roles.edit');
    Route::post('/roles/update/',[App\Http\Controllers\RoleController::class,'update'])->name('admin.roles.update');
    // User Routes
    Route::resource('users',App\Http\Controllers\UserController::class);

    // Manager code snipt Route
    Route::resource('codesnipt', App\Http\Controllers\CodesniptController::class);
    
});

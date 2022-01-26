<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProcessController;

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

Route::get('/', function () { return view('home');})->name("home");
Route::resource('/dashboard', DashboardController::class)->middleware('auth');
Route::get('/document/active', [DocumentController::class, 'active'])->name("document.active")->middleware('auth');
Route::get('/document/nonactive', [DocumentController::class, 'nonactive'])->name("document.nonactive")->middleware('auth');
Route::resource('/document', DocumentController::class)->middleware('auth');
Route::resource('/process', ProcessController::class,['except' => ['update']])->middleware('auth');
Route::get('/process/download/{file}', [ProcessController::class, 'download'])->name("process.download");
Route::post('/process/upload', [ProcessController::class, 'upload'])->name("process.commit.upload");
Route::delete('/process/delete/{file}', [ProcessController::class, 'delete'])->name("process.commit.delete");
Route::match( ['put', 'patch'], '/process/{document}', [ProcessController::class, 'update'])->name("process.update");
Route::resource('/profile', ProfileController::class)->middleware('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name("logout");
Route::get('/login', [LoginController::class, 'index'])->name("login");
Route::get('/register', [LoginController::class, 'register'])->name("register");
Route::post('/login', [LoginController::class, 'postLogin']);
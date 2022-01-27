<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\DocumentFlowController;
use App\Http\Controllers\UserController;

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
Route::get('/documentation', function () { return view('panel.documentation');})->name("documentation")->middleware('auth');
Route::get('/dashboard', [DashboardController::class,'index'])->name("dashboard.index")->middleware('auth');
Route::get('/document/active', [DocumentController::class, 'active'])->name("document.active")->middleware('auth');
Route::get('/document/nonactive', [DocumentController::class, 'nonactive'])->name("document.nonactive")->middleware('auth');
Route::resource('/document', DocumentController::class)->middleware('auth');
Route::resource('/process', ProcessController::class,['except'=>['create','destroy','edit','store']])->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');

Route::get('/process/download/{file}', [ProcessController::class, 'download'])->name("process.download");
Route::get('/process/download/{file}', [ProcessController::class, 'download'])->name("process.download");
Route::get('/document/download/{file}', [DocumentController::class, 'download'])->name("document.download");
Route::post('/process/upload', [ProcessController::class, 'upload'])->name("process.commit.upload");
Route::delete('/process/delete/{file}', [ProcessController::class, 'delete'])->name("process.commit.delete");
Route::match( ['put', 'patch'], '/process/{document}', [ProcessController::class, 'update'])->name("process.update")->middleware('auth');
Route::get('/profile', [ProfileController::class,'index'])->name("profile.index")->middleware('auth');
Route::get('/profile/password', [ProfileController::class, 'password'])->name("profile.password")->middleware('auth');
Route::post('/profile/password', [ProfileController::class, 'postPassword'])->middleware('auth');
Route::post('/profile/upload', [ProfileController::class, 'upload'])->name("profile.upload")->middleware('auth');
Route::match( ['put', 'patch'], '/profile', [ProfileController::class, 'update'])->name("profile.update")->middleware('auth');
Route::post('/process/upload', [ProcessController::class, 'upload'])->name("process.commit.upload")->middleware('auth');
Route::resource('/documentflow', DocumentFlowController::class,['except'=>['create']])->middleware('auth');
Route::get('/documentflow/{documentflow}/create', [DocumentFlowController::class,'create'])->name('documentflow.create')->middleware('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name("logout");
Route::get('/login', [LoginController::class, 'index'])->name("login");
Route::post('/login', [LoginController::class, 'postLogin']);
Route::get('/register', [LoginController::class, 'register'])->name("register");
Route::post('/register', [LoginController::class, 'postRegister']);
Route::get('/forget', [LoginController::class, 'forget'])->name("forget");
Route::post('/forget', [LoginController::class, 'postForget']);
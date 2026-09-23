<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home']);
Route::get('/home', [FrontendController::class, 'home']);
Route::get('/home/doctors', [FrontendController::class, 'doctors']);
Route::get('/home/doctors/{id}', [FrontendController::class, 'doctor']);
Route::get('/home/department/{id}', [FrontendController::class, 'department']);
Route::get('/home/about_us', [FrontendController::class, 'about']);
Route::get('/home/appointment', [FrontendController::class, 'appointment']);
Route::get('/home/blog', [FrontendController::class, 'blog']);
Route::get('/home/contact_us', [FrontendController::class, 'contact']);
Route::get('/login', [FrontendController::class, 'login']);

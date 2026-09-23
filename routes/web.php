<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\TriageController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('/home', [FrontendController::class, 'home']);
Route::get('/home/doctors', [FrontendController::class, 'doctors']);
Route::get('/home/doctors/{id}', [FrontendController::class, 'doctor']);
Route::get('/home/department/{id}', [FrontendController::class, 'department']);
Route::get('/home/about_us', [FrontendController::class, 'about']);
Route::get('/home/appointment', [FrontendController::class, 'appointment']);
Route::get('/home/blog', [FrontendController::class, 'blog']);
Route::get('/home/contact_us', [FrontendController::class, 'contact']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:staff')->group(function () {
        Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
        Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
        Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
        Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');

        Route::post('/patients/{patient}/visits', [VisitController::class, 'store'])->name('visits.store');

        Route::get('/visits/{visit}/triage', [TriageController::class, 'edit'])->name('triage.edit');
        Route::put('/visits/{visit}/triage', [TriageController::class, 'update'])->name('triage.update');

        Route::post('/prescriptions/{prescription}/dispense', [PrescriptionController::class, 'dispense'])->name('prescriptions.dispense');
    });

    Route::middleware('role:doctor')->group(function () {
        Route::get('/consultations/{visit}', [ConsultationController::class, 'show'])->name('consultations.show');
        Route::put('/consultations/{visit}', [ConsultationController::class, 'update'])->name('consultations.update');

        Route::delete('/prescriptions/{prescription}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');
    });
});

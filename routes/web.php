<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BloodSugarController;
use App\Http\Controllers\LaboratoryController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');

Route::post('/patients/{id}/blood-sugar', [BloodSugarController::class, 'store'])->name('blood-sugar.store');
Route::get('/patients/{id}/blood-sugar', [BloodSugarController::class, 'index'])->name('patients.blood-sugar.index');


Route::get('/blood-sugar/create', [BloodSugarController::class, 'create']);
Route::post('/blood-sugar/store', [BloodSugarController::class, 'store']);

Route::post('/patients/{patient}/laboratory', [LaboratoryController::class, 'store'])->name('patients.laboratory.store');
Route::post('/patients/{patient}/laboratory/upload', [LaboratoryController::class, 'uploadLabResult'])->name('patients.laboratory.upload');







require __DIR__.'/auth.php';

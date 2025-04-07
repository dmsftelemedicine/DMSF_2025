<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BloodSugarController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\TelemedicinePerceptionController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\FoodRecallController;
use App\Http\Controllers\TdeeController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\QualityOfLifeController;
use App\Http\Controllers\SocialConnectednessController;
use App\Http\Controllers\StressManagementController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PrescriptionController;
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

Route::get('/patient/{patient_id}/macronutrients', [PatientController::class, 'getMacronutrients']);

Route::post('/patients/{id}/blood-sugar', [BloodSugarController::class, 'store'])->name('blood-sugar.store');
Route::get('/patients/{id}/blood-sugar', [BloodSugarController::class, 'index'])->name('patients.blood-sugar.index');

Route::get('/blood-sugar/create', [BloodSugarController::class, 'create']);
Route::post('/blood-sugar/store', [BloodSugarController::class, 'store']);

Route::post('/telemedicine_perception/store', [TelemedicinePerceptionController::class, 'store'])->name('telemedicine_perception.store');

Route::post('/patients/{patient}/laboratory', [LaboratoryController::class, 'store'])->name('patients.laboratory.store');
Route::post('/patients/{patient}/laboratory/upload', [LaboratoryController::class, 'uploadLabResult'])->name('patients.laboratory.upload');

Route::post('/nutrition/store', [NutritionController::class, 'store'])->name('nutrition.store');

Route::post('/food-recall/store', [FoodRecallController::class, 'store'])->name('food-recall.store');
Route::get('/food-recall/{nutritionId}', [FoodRecallController::class, 'getFoodRecalls']);

Route::post('/tdee', [TdeeController::class, 'store'])->name('tdee.store');

Route::get('/get-meal-plans/{patient}', [MealPlanController::class, 'getMealPlans'])->name('get-meal-plans');

Route::post('/save-meal-plan', [MealPlanController::class, 'store'])->name('save-meal-plan');

Route::post('/qualityoflife/store', [QualityOfLifeController::class, 'store'])->name('qualityoflife.store');
Route::get('/qualityoflife/{patient_id}', [QualityOfLifeController::class, 'index'])->name('qualityoflife.index');

Route::post('/social-connectedness', [SocialConnectednessController::class, 'store'])->name('submit.socialConnectedness');
Route::get('/social-connectedness/{patient_id}', [SocialConnectednessController::class, 'show'])->name('get.socialConnectedness');

Route::post('/stress-management', [StressManagementController::class, 'store'])->name('submit.stressManagement');
Route::get('/stress-management/{patientId}', [StressManagementController::class, 'getDataByPatient'])->name('stressManagement.getDataByPatient');

Route::get('/medicines/search', [MedicineController::class, 'getMedicines'])->name('medicines.search');


Route::post('/prescription-add', [PrescriptionController::class, 'store'])->name('prescription.store');
Route::get('/prescription/{prescriptionId}/print', [PrescriptionController::class, 'print']);

Route::get('/patients/{patient}/prescriptions', [PrescriptionController::class, 'getByPatient'])->name('patients.prescriptions');



require __DIR__.'/auth.php';

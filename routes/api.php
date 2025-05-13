<?php
use Illuminate\Support\Facades\Route;

Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login'])->name('login');
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::get('me', [App\Http\Controllers\API\AuthController::class, 'me']);

    Route::get('list-patient', [App\Http\Controllers\API\PatientController::class, 'index']);
    Route::get('detail-patient/{id}', [App\Http\Controllers\API\PatientController::class, 'detail']);
    Route::post('/patient-create', [App\Http\Controllers\API\PatientController::class, 'create']);
    Route::post('/patient-update/{id}', [App\Http\Controllers\API\PatientController::class, 'update']);
});

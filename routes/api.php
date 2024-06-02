<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraPriceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PromocodeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('reset-password', [AuthController::class, 'reset_password']);
Route::post('create-new-password', [AuthController::class, 'create_new_password']);

// Users
Route::post('users', [UserController::class, 'store']);

// User companies
Route::post('company/store', [CompanyController::class, 'store']);
Route::get('company/{user_id}', [CompanyController::class, 'index']);
Route::delete('company/{id}', [CompanyController::class, 'destroy']);

// Messages
Route::get('messages', [MessageController::class, 'index']);
Route::post('messages', [MessageController::class, 'store']);
Route::get('messages/{id}', [MessageController::class, 'show']);
Route::post('messages/{id}', [MessageController::class, 'update']);
Route::delete('messages/{id}', [MessageController::class, 'destroy']);

// Promocodes
Route::get('promocodes', [PromocodeController::class, 'index']);
Route::get('promocodes/{id}', [PromocodeController::class, 'show']);

// Contract
Route::get('contracts/{id}', [ContractController::class, 'show']);
Route::get('contracts/search/{id}', [ContractController::class, 'search']);

// Visit requests
Route::get('visit-request', [TicketController::class, 'index']);
Route::post('visit-request', [TicketController::class, 'store']);
Route::get('visit-request/search/{email}', [TicketController::class, 'search']);

// Camera Price
Route::get('camera-prices', [CameraPriceController::class, 'index']);

// ******************* \\
// Authenticated Routes  \\
// *********************** \\
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Auth
    Route::post('send-verification-email', [AuthController::class, 'send_verification_email']);
    Route::get('verify-email/{id}/{token}', [AuthController::class, 'verify_email'])->name('verification.verify');
    Route::get('logout', [AuthController::class, 'logout']);

    // Users
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/count', [UserController::class, 'count']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users/{id}', [UserController::class, 'update']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    // Contracts
    Route::get('contracts', [ContractController::class, 'index']);
    Route::get('contracts/count', [ContractController::class, 'count']);
    Route::get('contracts/sales', [ContractController::class, 'sales']);
    Route::post('contracts/apply-discount', [ContractController::class, 'apply_discount']);
    Route::post('contracts/apply-payment', [ContractController::class, 'apply_payment']);
    Route::get('contracts/search_name/{name}', [ContractController::class, 'search_by_name']);
    Route::post('contracts', [ContractController::class, 'store']);
    Route::post('contracts/renew-contract', [ContractController::class, 'renew_contract']);
    Route::post('contracts/{id}', [ContractController::class, 'update']);
    Route::delete('contracts/{id}', [ContractController::class, 'destroy']);

    // Promo codes
    Route::post('promocodes', [PromocodeController::class, 'store']);
    Route::post('promocodes/{id}', [PromocodeController::class, 'update']);
    Route::delete('promocodes/{id}', [PromocodeController::class, 'destroy']);

    // Visit requests
    Route::delete('visit-request/{id}', [TicketController::class, 'destroy']);

    // Camera Price
    Route::post('camera-prices', [CameraPriceController::class, 'store']);
    Route::put('camera-prices/{id}', [CameraPriceController::class, 'update']);
    Route::delete('camera-prices/{id}', [CameraPriceController::class, 'destroy']);
});

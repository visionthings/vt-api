<?php

use App\Http\Controllers\AdminMailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraPriceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PromocodeController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\AdminMail;
use Carbon\Carbon;
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
Route::post('messages', [MessageController::class, 'store']);
Route::get('messages/{id}', [MessageController::class, 'show']);
Route::post('messages/{id}', [MessageController::class, 'update']);

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

    // Admin Mail
    Route::post('send-mail', [AdminMailController::class, 'send_mail']);
    Route::get('messages', [MessageController::class, 'index']);
    Route::get('outbox', [AdminMailController::class, 'outbox']);
    // Delete from outbox
    Route::delete('delete-mail/{id}', [AdminMailController::class, 'delete']);
    // Delete from inbox
    Route::delete('messages/{id}', [MessageController::class, 'destroy']);

    // Users
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/check-auth', [UserController::class, 'check_auth']);
    Route::get('users/blocked', [UserController::class, 'blocked']);
    Route::get('users/count', [UserController::class, 'count']);
    Route::get('users/search/{name}', [UserController::class, 'search']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users/{id}', [UserController::class, 'update']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
    Route::get('users/block/{id}', [UserController::class, 'block']);
    Route::get('users/unblock/{id}', [UserController::class, 'unblock']);

    // Contracts
    Route::get('contracts', [ContractController::class, 'index']);
    Route::get('contracts/{id}', [ContractController::class, 'show']);
    Route::get('contracts/search/{id}', [ContractController::class, 'search']);
    Route::get('contracts/filter/{id}', [ContractController::class, 'filter']);
    Route::get('contracts/count', [ContractController::class, 'count']);
    Route::get('contracts/sales', [ContractController::class, 'sales']);
    Route::post('contracts/apply-discount', [ContractController::class, 'apply_discount']);
    Route::post('contracts/apply-payment', [ContractController::class, 'apply_payment']);
    Route::post('contracts', [ContractController::class, 'store']);
    Route::post('contracts/create-paid-contract', [ContractController::class, 'create_paid_contract']);
    Route::post('contracts/renew-contract', [ContractController::class, 'renew_contract']);
    Route::post('contracts/{id}', [ContractController::class, 'update']);
    Route::delete('contracts/{id}', [ContractController::class, 'destroy']);

    // Promo codes
    Route::get('promocodes', [PromocodeController::class, 'index']);
    Route::post('promocodes', [PromocodeController::class, 'store']);
    Route::post('promocodes/{id}', [PromocodeController::class, 'update']);
    Route::get('promocodes/{id}', [PromocodeController::class, 'show']);
    Route::delete('promocodes/{id}', [PromocodeController::class, 'destroy']);

    // Visit requests
    Route::get('open-visit-requests', [TicketController::class, 'open_tickets']);
    Route::get('closed-visit-requests', [TicketController::class, 'closed_tickets']);
    Route::post('close-ticket/{id}', [TicketController::class, 'close_ticket']);
    Route::delete('visit-request/{id}', [TicketController::class, 'destroy']);

    // Camera Price
    Route::post('camera-prices', [CameraPriceController::class, 'store']);
    Route::put('camera-prices/{id}', [CameraPriceController::class, 'update']);
    Route::delete('camera-prices/{id}', [CameraPriceController::class, 'destroy']);

    // Stats
    Route::get('stats/overview', [StatsController::class, 'overview']);
    Route::get('stats/contracts', [StatsController::class, 'contracts']);
    Route::get('stats/sales', [StatsController::class, 'sales']);
    Route::get('stats/requests', [StatsController::class, 'contracts']);
});

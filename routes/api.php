<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\FailedPaymentController;
use App\Http\Controllers\InterestedMessageController;
use App\Http\Controllers\NavEleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PromocodeController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\UncompletedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitRequestController;
use App\Http\Controllers\VisitsController;
use App\Models\Content;
use App\Models\Contract;
use App\Models\Promocode;
use App\Models\Uncompleted;
use App\Models\VisitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
    // Users Register & Login
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('login', [AuthController::class, 'login']);

    // ContactMessages
    Route::get('contact-messages', [ContactMessageController::class, 'index']);
    Route::post('contact-messages', [ContactMessageController::class, 'store']);
    Route::get('contact-messages/{id}', [ContactMessageController::class, 'show']);
    Route::post('contact-messages/{id}', [ContactMessageController::class, 'update']);
    Route::delete('contact-messages/{id}', [ContactMessageController::class, 'destroy']);

    // InterestedMessages
    Route::get('interested-messages', [InterestedMessageController::class, 'index']);
    Route::post('interested-messages', [InterestedMessageController::class, 'store']);
    Route::get('interested-messages/{id}', [InterestedMessageController::class, 'show']);
    Route::post('interested-messages/{id}', [InterestedMessageController::class, 'update']);
    Route::delete('interested-messages/{id}', [InterestedMessageController::class, 'destroy']);

    // Nav elements
    Route::get('nav-elements', [NavEleController::class, 'index']);
    Route::get('nav-elements/{id}', [NavEleController::class, 'show']);

    // Pages
    Route::get('pages', [PageController::class, 'index']);
    Route::get('pages/{id}', [PageController::class, 'show']);

    // Contents
    Route::get('contents', [ContentController::class, 'index']);
    Route::get('contents/{id}', [ContentController::class, 'show']);

    // Promocodes
    Route::get('promocodes', [PromocodeController::class, 'index']);

    Route::get('promocodes/{id}', [PromocodeController::class, 'show']);
    Route::post('promocodes/{id}', [PromocodeController::class, 'update']);
    Route::delete('promocodes/{id}', [PromocodeController::class, 'destroy']);

    // Contracts
    Route::get('contracts', [ContractController::class, 'index']);
    Route::get('contracts/count', [ContractController::class, 'count']);
    Route::get('contracts/number', [ContractController::class, 'number']);
    Route::get('contracts/sales', [ContractController::class, 'sales']);
    Route::get('contracts/search/{contract_number}', [ContractController::class, 'search']);
    Route::get('contracts/search_name/{name}', [ContractController::class, 'search_name']);
    Route::post('contracts', [ContractController::class, 'store']);
    Route::get('contracts/{id}', [ContractController::class, 'show']);
    Route::post('contracts/{id}', [ContractController::class, 'update']);
    Route::delete('contracts/{id}', [ContractController::class, 'destroy']);

    // Uncompleted
    Route::get('uncompleted', [UncompletedController::class, 'index']);
    Route::post('uncompleted', [UncompletedController::class, 'store']);
    Route::get('uncompleted/{id}', [UncompletedController::class, 'show']);
    Route::post('uncompleted/{id}', [UncompletedController::class, 'update']);
    Route::delete('uncompleted/{id}', [UncompletedController::class, 'destroy']);

    // Failed payments
    Route::get('failedpayments', [FailedPaymentController::class, 'index']);
    Route::get('failedpayments/count', [FailedPaymentController::class, 'count']);
    Route::post('failedpayments', [FailedPaymentController::class, 'store']);
    Route::get('failedpayments/{id}', [FailedPaymentController::class, 'show']);
    Route::post('failedpayments/{id}', [FailedPaymentController::class, 'update']);
    Route::delete('failedpayments/{id}', [FailedPaymentController::class, 'destroy']);

    // Visitors
    Route::get('visits', [VisitsController::class, 'index']); 
    Route::get('visits/count', [VisitsController::class, 'count']); 
    Route::post('visits', [VisitsController::class, 'store']); 


     // Users
        Route::get('users', [UserController::class, 'index'] );
        Route::post('users', [UserController::class, 'store'] );
        Route::get('users/{id}', [UserController::class, 'show'] );
        Route::post('users/{id}', [UserController::class, 'update'] );
        Route::put('users/{id}', [UserController::class, 'update'] );
        Route::delete('users/{id}', [UserController::class, 'destroy'] );

        // Nav Elements
        Route::post('nav-elements', [NavEleController::class, 'store']);
        Route::post('nav-elements/{id}', [NavEleController::class, 'update']);
        Route::delete('nav-elements/{id}', [NavEleController::class, 'destroy']);

        // Pages
        Route::post('pages', [PageController::class, 'store']);
        Route::post('pages/{id}', [PageController::class, 'update']);
        Route::delete('pages/{id}', [PageController::class, 'destroy']);

        // Contents
        Route::post('contents', [ContentController::class, 'store']);
        Route::post('contents/{id}', [ContentController::class, 'update']);
        Route::delete('contents/{id}', [ContentController::class, 'destroy']);

        // Promocodes
        Route::post('promocodes', [PromocodeController::class, 'store']);
    // Protected Routes
    // Route::group(['middleware' => ['auth:sanctum']], function() {

    // });

        // SMS Verification 
        Route::post('sms/{number}', [SMSController::class, 'create']);
        Route::get('sms', [SMSController::class, 'verify']);

        // Visit requests
        Route::get('visit-request', [VisitRequestController::class, 'index']);
        Route::post('visit-request', [VisitRequestController::class, 'store']);
        Route::get('visit-request/search/{email}', [VisitRequestController::class, 'search']);


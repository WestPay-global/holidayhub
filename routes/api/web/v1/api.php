<?php
namespace App\Http\Controllers\Web\V1;
use Illuminate\Support\Facades\Route;
use App\CentralLogics\Helpers;

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('social-login', [AuthController::class, 'social-login']);
    // Route::get('profile', [AuthController::class, 'profile']);

    ////forgot password
    // Route::post('forgot-password', 'ForgotPasswordController@sendResetLink');
    // Route::post('reset-password', 'ForgotPasswordController@resetPassword');
    // Route::post('change-password', 'ForgotPasswordController@changePassword')->middleware('auth');
});

Route::group(['prefix' => 'homeswap'], function () {
    Route::get('/all', [HomeSwapController::class, 'allHomeSwap']);
    Route::get('/single/{id}', [HomeSwapController::class, 'singleHomeSwap']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'homeswap'], function () {
    Route::get('/my-swaps', [HomeSwapController::class, 'myTasks']);
    Route::get('/single-swap/{id}', [HomeSwapController::class, 'singleTask']);
    Route::post('/store', [HomeSwapController::class, 'store']);
    Route::post('/update-swap/{id}', [HomeSwapController::class, 'updateTask']);
    // Route::get('/task-offers/{task_id?}', [HomeSwapController::class, 'taskOffers']);
    // Route::get('/single-offer/{task_offer_id}', [HomeSwapController::class, 'singleOffer']);
    // Route::post('/accept-offer/{task_offer_id}', [HomeSwapController::class, 'acceptOffer']);
    // Route::post('/confirm-payment', [HomeSwapController::class, 'confirmPayment']);
});

<?php
namespace App\Http\Controllers\Mobile\V1;
use Illuminate\Support\Facades\Route;
use App\CentralLogics\Helpers;

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('social-login', [AuthController::class, 'socialLogin']);
    Route::get('/auto-login', [AuthController::class, 'handleAutoLogin']);
    // Route::get('profile', [AuthController::class, 'profile']);

    ////forgot password
    // Route::post('forgot-password', 'ForgotPasswordController@sendResetLink');
    // Route::post('reset-password', 'ForgotPasswordController@resetPassword');
    // Route::post('change-password', 'ForgotPasswordController@changePassword');
});

Route::group(['prefix' => 'homeswap'], function () {
    Route::get('/all', [HomeSwapController::class, 'allHomeSwap']);
    Route::get('/single/{id}', [HomeSwapController::class, 'singleHomeSwap']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/my-all', [HomeSwapController::class, 'myAllHomeSwap']);
        Route::post('/store', [HomeSwapController::class, 'store']);
        Route::post('/update/{id}', [HomeSwapController::class, 'update']);
        Route::get('/publish/{id}', [HomeSwapController::class, 'publish']);

        Route::get('/deactivate/{id}', [HomeSwapController::class, 'deactivateHomeSwap']);
        Route::get('/activate/{id}', [HomeSwapController::class, 'activateHomeSwap']);
        Route::get('/delete/{id}', [HomeSwapController::class, 'deleteHomeSwap']);

    });
});

//non swap reservation
Route::group(['prefix' => 'nonswap'], function () {
    Route::get('/all', [NonSwapController::class, 'allNonSwap']);
    Route::get('/single/{id}', [NonSwapController::class, 'singleNonSwap']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/my-all', [NonSwapController::class, 'myAllNonSwap']);
        Route::post('/store', [NonSwapController::class, 'store']);
        Route::post('/update/{id}', [NonSwapController::class, 'update']);
        Route::get('/publish/{id}', [NonSwapController::class, 'publish']);

        Route::get('/deactivate/{id}', [NonSwapController::class, 'deactivateNonSwap']);
        Route::get('/activate/{id}', [NonSwapController::class, 'activateNonSwap']);
        Route::get('/delete/{id}', [NonSwapController::class, 'deleteNonSwap']);

    });
});

//wishlists
Route::group(['middleware' => 'auth', 'prefix' => 'wishlist'], function () {
    Route::get('get-all', [WishListController::class, 'getAll']);
    Route::post('store', [WishListController::class, 'store']);
    Route::get('remove/{id}', [WishListController::class, 'remove']);
});

//list-offer
Route::group(['middleware' => 'auth', 'prefix' => 'list-offer'], function () {
    Route::get('my-offers/{status}/{list_type}', [ListOfferController::class, 'myListOffers']);
    Route::post('offer-an-exchange/{list_id}', [ListOfferController::class, 'offerAnExchange']);
    Route::get('owner-pre-approve/{list_offer_id}', [ListOfferController::class, 'ownerPreApproveOffer']);
    Route::post('owner-cancel/{list_offer_id}', [ListOfferController::class, 'ownerCancelOffer']);
});

//fcm
Route::group(['middleware' => 'auth', 'prefix' => 'fcm'], function () {
    Route::post('/store-token', [FCMTokenController::class, 'store']);
});

Route::group(['prefix' => 'chat'], function () {
    Route::post('/send-message', [MessageController::class, 'sendMessage']);
    Route::get('/history/{task_offer_id}/{selected_user_id}', [MessageController::class, 'chatHistory']);
    Route::get('/contacts', [MessageController::class, 'chatContacts']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'wallet'], function () {
    Route::get('/balance', [WalletController::class, 'getBalance']);
    Route::post('/earnings', [WalletController::class, 'addEarnings']);
    Route::post('/withdraw', [WalletController::class, 'withdraw']);
});


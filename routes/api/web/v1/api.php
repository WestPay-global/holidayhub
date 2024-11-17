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

//wishlists
Route::group(['middleware' => 'auth', 'prefix' => 'wishlist'], function () {
    Route::get('get-all', [WishListController::class, 'getAll']);
    Route::post('store', [WishListController::class, 'store']);
    Route::get('remove/{id}', [WishListController::class, 'remove']);
});

//list-offer
Route::group(['middleware' => 'auth', 'prefix' => 'list-offer'], function () {
    Route::get('my-offers/{status}', [ListOfferController::class, 'myListOffers']);
    Route::post('offer-an-exchange/{list_id}', [ListOfferController::class, 'offerAnExchange']);
    Route::get('owner-pre-approve/{list_offer_id}', [ListOfferController::class, 'ownerPreApproveOffer']);
    Route::post('owner-cancel/{list_offer_id}', [ListOfferController::class, 'ownerCancelOffer']);
});



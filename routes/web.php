<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('login', function () {
    $errors = [];
    // array_push($errors, ['success'=>false, 'code' => 'auth-001', 'message' => 'Unauthenticated.', 'headers' => $request->bearerToken()]);
    array_push($errors, ['success'=>false, 'code' => 'auth-001', 'message' => 'Unauthenticated.']);
    return response()->json([
        'errors' => $errors,
    ], 401);
})->name('login');

////admin/////////////
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'adminDashboard'])->name('adminDashboard')->middleware('auth:web');
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
        Route::get('/login', [DashboardController::class, 'login'])->name('login');
        Route::post('/login', [DashboardController::class, 'loginPost'])->name('loginPost');
        Route::get('/autologin/{section}', [DashboardController::class, 'autologin'])->name('autologin');
        Route::get('/auto-login', [DashboardController::class, 'handleAutoLogin'])->name('handleAutoLogin');
    });
});

Route::group(['middleware' => 'auth:web', 'prefix' => 'users'], function () {
    Route::get('/{list_type?}', [DashboardController::class, 'allUser'])->name('allUser');
    Route::get('/single/{user_id}', [DashboardController::class, 'singleUser'])->name('singleUser');
});

Route::group(['middleware' => 'auth:web', 'prefix' => 'homeswaps'], function () {
    Route::get('/{status?}', [DashboardController::class, 'allHomeSwap'])->name('allHomeSwap');
    Route::get('/single/{list_id}', [DashboardController::class, 'singleHomeSwap'])->name('singleHomeSwap');
});

Route::group(['middleware' => 'auth:web', 'prefix' => 'nonswaps'], function () {
    Route::get('/{status?}', [DashboardController::class, 'allNonSwap'])->name('allNonSwap');
    Route::get('/single/{list_id}', [DashboardController::class, 'singleNonSwap'])->name('singleNonSwap');
});

Route::group(['middleware' => 'auth:web', 'prefix' => 'offers'], function () {
    Route::get('/{status?}', [DashboardController::class, 'allOffer'])->name('allOffer');
    Route::get('/single/{list_offer_id}', [DashboardController::class, 'singleOffer'])->name('singleOffer');
});


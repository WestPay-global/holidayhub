<?php

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

Route::get('login', function () {
    $errors = [];
    // array_push($errors, ['success'=>false, 'code' => 'auth-001', 'message' => 'Unauthenticated.', 'headers' => $request->bearerToken()]);
    array_push($errors, ['success'=>false, 'code' => 'auth-001', 'message' => 'Unauthenticated.']);
    return response()->json([
        'errors' => $errors,
    ], 401);
})->name('login');

Route::get('/', function () {
    return view('welcome');
});

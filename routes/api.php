<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});

//CONTACTS
Route::group([
    'middleware' => ['jwt.auth', 'isUserActive'],
], function () {
    Route::get('/contacts', [ContactController::class, 'getAllContacts']);
    Route::get('/contact/{id}', [ContactController::class, 'getContactById']);
    Route::post('/contact', [ContactController::class, 'createContact']);
    Route::put('/contacts/{id}', [ContactController::class, 'updateContact']);
    Route::delete('/contacts/{id}', [ContactController::class, 'deleteContact']);
});

<?php

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


//CONTACTS

Route::get('/contacts', function() {
    return 'GET ALL CONTACTS';
});

Route::get('/contact/{id}', function($id) {
    return 'GET CONTACT BY ID-> '. $id;
});

Route::post('/contact', function(Request $request) {
    return 'CREATE CONTACT BY ID';
});

Route::put('/contacts/{id}', function($id) {
    return 'UPDATE CONTACT BY ID'. $id;
});

Route::delete('/contacts/{id}', function($id) {
    return 'DELETE CONTACT BY ID'. $id;;
});

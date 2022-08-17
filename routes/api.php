<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerExample;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;

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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



################################## Begin User Routes ##################################
Route::group(['middleware' => 'token:api'], function () {


    ######################### User Routes ##################################
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user-update', [AuthController::class, 'user_update']);
    Route::post('/profiles', [AuthController::class, 'get_profiles_user']);
    Route::post('/get-all-users', [AuthController::class, 'get_all_users']);

    ################################## Property  Routes #####################
    Route::Post('/add_property', [PropertyController::class, 'store']);
    Route::Post('/show_property_id', [PropertyController::class, 'show']);
    Route::Post('/delete_property_id', [PropertyController::class, 'delete']);
    Route::Post('/update_property', [PropertyController::class, 'update']);
    Route::Post('/get-all-property-for-user', [PropertyController::class, 'get_all_property_for_user']);
    Route::Post('/get-all-property-for-me', [PropertyController::class, 'get_all_property_for_me']);
    Route::Post('/get-all-properties', [PropertyController::class, 'get_all_properties']);

    # ****************************** new **********************************************************
    Route::Post('/get-properties-by-type', [PropertyController::class, 'get_properties_by_type']);


});




################################## Begin Admin Routes ##################################
Route::group(['middleware' => 'token:admin'], function () {



});





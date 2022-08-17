<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\propertyController;
use App\Http\Controllers\Admin\townController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Admin' ,'prefix'=>'admin' ,'middleware' => 'guest:web'],function () {

    Route::get('login', [AdminController::class,'getLogin'])->name('adminLogin');
    Route::post('login', [AdminController::class,'postLogin'])->name('adminLogin');



    Route::group(['middleware' => 'auth:admin'], function () {


        Route::get('dashboard', [AdminController::class,'dashboard'])->name('adminDashboard');
        Route::get('logout', [AdminController::class,'logout'])->name('adminLogout');
        Route::get('settings', [AdminController::class,'settings'])->name('adminSettings');
        Route::post('settings', [AdminController::class,'updatePassword'])->name('adminSettings');

        # ********************** Site settings  ****************************
        Route::get('site.settings', [AdminController::class,'Site_settings'])->name('site.settings');


    ########## Begin property Route (Admin) ##########
    Route::get('add-property', [propertyController::class,'create'])->name('add.property');
    Route::post('add-property', [propertyController::class,'store'])->name('store.new.property');
    Route::get('view-properties', [propertyController::class,'index'])->name('view.properties');
    Route::get('edit-property/{id}', [propertyController::class,'edit'])->name('edit.property');
    Route::get('Property-activated/{id}', [propertyController::class,'cheng_stutus'])->name('Property.activated');
    Route::post('update-property/{id}', [propertyController::class,'update'])->name('update.property');
    Route::get('delete-property/{id}', [propertyController::class,'delete'])->name('delete.property');
    Route::get('show-property/{id}', [propertyController::class,'show'])->name('show.property');
    ########## End property Route (Admin) ##########



    ########## Begin city Route (Admin) ##########
    Route::get('add-city', [CityController::class,'create'])->name('add.city');
    Route::post('add-city', [CityController::class,'store'])->name('store.new.city');
    Route::get('view-categories', [CityController::class,'index'])->name('view.city');
    Route::get('edit-city/{id}', [CityController::class,'edit'])->name('edit.city');
    Route::post('update-city/{id}',[CityController::class,'update'] )->name('update.city');
    Route::post('delete-city', [CityController::class,'delete'])->name('delete.city');
    ########## End city Route (Admin) ##########


    ########## Begin Town Route (Admin) ##########
    Route::get('add-town', [townController::class,'create'])->name('add.town');
    Route::post('add-town', [townController::class,'store'])->name('store.new.town');
    Route::get('view-towns',  [townController::class,'index'])->name('view.town');
    Route::get('edit-town/{id}',  [townController::class,'edit'])->name('edit.town');
    Route::post('update-town/{id}',  [townController::class,'update'])->name('update.town');
    Route::post('delete-town',  [townController::class,'delete'])->name('delete.town');
    Route::get('show-town-products/{id}',  [townController::class,'show'])->name('show.subCategoryProduct');
    ########## End Town Route (Admin) ##########



    ########## Begin Users Route (Admin) ##########
    Route::get('normal-users', [UsersController::class,'ShowNormalUser'])->name('show.normal.users');
    Route::get('Admins', [UsersController::class,'ShowAdmin'])->name('show.all.admin');
    Route::post('normal-users', [UsersController::class,'addAdmain'])->name('user.to.admin');

    #**************************** new  ****************************

    Route::get('user.to.subscriber.user/{id}', [UsersController::class,'addSubscriber'])->name('user.to.subscriber.user');
    Route::post('maximum.number.free.property', [UsersController::class,'maximum_number_free_property'])->name('maximum.number.free.property');
    Route::get('get.Best.Customer', [UsersController::class,'getBestCustomer'])->name('get.Best.Customer');



        ########## End Users Route (Admin) ##########

});



});

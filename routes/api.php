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

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});
Route::group(['middleware'=>'auth:api'],function (){

    Route::apiResource('/user_type','UserTypesController');
    Route::apiResource('/donor_type','DonorTypesController');

    Route::apiResource('/blood_group','BloodGroupsController');
    Route::apiResource('/product_type','ProductTypesController');
    Route::apiResource('/storage_location','StorageLocationController');
    Route::apiResource('/virus','VirusesController');

    Route::group(['middleware'=>'admin'],function(){
        Route::apiResources([
            '/staff'=>'StaffController',
            '/user'=>'UserController'
        ]);
    });

    Route::group(['middleware'=>'blood.bank.staff'],function (){
        Route::apiResources([
            '/blood_product'=>'BloodProductsController',
            '/handled_request'=>'HandledRequestsController'
        ]);
    });

    Route::group(['middleware'=>'can.access.donor.and.activity'],function (){
        Route::apiResources([
            '/donor'=>'DonorsController',
            '/donor_activity'=>'DonorActivityController'
        ]);
    });
    Route::post('/email-unique',function($request){
        //validation is email or not  and required
      $count= \App\User::where('email',$request->get('email'))-get()->count();
       if($count>0)
           return response()->json(['error'=>'email is found','success'=>false]);
       else
           return response()->json(['message'=>'email is not found','success'=>true]);
    });

    Route::apiResource('/patient','PatientsController')->middleware('can.access.patient');

    Route::apiResource('/request','RequestsController')->middleware('can.access.request');



});

//Route::apiResource('/staff','StaffController');

// Route::get('/donor/','DonorsController@index');
// Route::patch('/donor/{donor}','DonorsController@update');
// Route::post('/donor/','DonorsController@store');
// Route::get('/donor/{donor}','DonorsController@show');
// Route::delete('/donor/{donor}','DonorsController@destroy');
//php artisan route:list //for displaying all routes in the system




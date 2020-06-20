<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        Route::apiResource('/staff','StaffController')->middleware('can.access.staff.show');

        Route::group(['middleware'=>'admin'],function(){
            Route::apiResources([
                //'/staff'=>'StaffController',
                '/user'=>'UserController'
            ]);
            Route::get('/import_excel', 'ImportExcelController@index');
            Route::post('/import_excel/import', 'ImportExcelController@import');
        });

        Route::group(['middleware'=>'donor'],function (){
            Route::get('/donor_info','DonorInfoController@showInfo');
            Route::get('/donor_activities','DonorInfoController@showActivities');

        });

        Route::get('/find_donor','DonorsController@findDonorBySSN')->middleware('blood.bank.staff');
        //blood bank staff
        Route::group(['middleware'=>'blood.bank.staff'],function (){
            Route::apiResources([
                '/blood_product'=>'BloodProductsController',
                '/handled_request'=>'HandledRequestsController',
                '/donor'=>'DonorsController',
                '/donor_activity'=>'DonorActivityController',
                '/expired_product'=>'ExpiredProductsController',

            ]);



            Route::get('stock',function(){

                /*$blood = DB::table('blood_products')
                    ->where('availability','=',1)
                    ->where('product_type_id','=',1)
                    ->select('blood_group_id' , DB::raw('count(*) as total'))
                    ->groupBy('blood_group_id')
                    ->get();
                echo $blood;*/

               /* $productTypes = DB::table('blood_products')
                    ->where('availability','=',1)
                    ->select('product_type_id' , DB::raw('count(*) as total'))
                    ->groupBy('product_type_id')
                    ->get();
                echo $productTypes;*/

                return DB::table('blood_products')
                    //->where('availability','=',1)
                    ->where('deleted_at','=',null)
                    ->select('blood_group_id','product_type_id' , DB::raw('count(*) as total'))
                    ->groupBy('blood_group_id','product_type_id')
                    ->get();


            });
        });





        Route::post('/email-unique',function($request){
            //validation is email or not  and required
            $this->validate($request,
                [
                    'email' => 'required|email',
                ]
            );

          $count= \App\User::where('email',$request->get('email'))-get()->count();
           if($count>0)
               return response()->json(['error'=>'email is found','success'=>false]);
           else
               return response()->json(['message'=>'email is not found','success'=>true]);
        });



        Route::apiResource('/patient','PatientsController')->middleware('can.access.patient');

        Route::get('/find_patient','PatientsController@findPatientBySSN')->middleware('can.access.patient');

        Route::apiResource('/request','RequestsController')->middleware('can.access.request');





    });



// Route::get('/donor/','DonorsController@index');
// Route::patch('/donor/{donor}','DonorsController@update');
// Route::post('/donor/','DonorsController@store');
// Route::get('/donor/{donor}','DonorsController@show');
// Route::delete('/donor/{donor}','DonorsController@destroy');
//php artisan route:list //for displaying all routes in the system




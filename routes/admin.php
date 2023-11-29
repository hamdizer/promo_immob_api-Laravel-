<?php
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ClientController;

Route::group([],function() {
    Route::post('register', [AdministratorController::class, 'register']);
    Route::post('login', [AdministratorController::class, 'login']);
    Route::group(['middleware'=>'admin'],function (){
        Route::post('logout', [AdministratorController::class, 'logout']);
        Route::post('me', [AdministratorController::class, 'me']);
    Route::group(['prefix'=>'agencies'],function (){
       Route::get('',[AgencyController::class,'index']);
        Route::post('',[AgencyController::class,'store']);
        Route::put('update/{id}',[AgencyController::class,'update']);
        Route::delete('delete/{id}',[AgencyController::class,'destroy']);
        });
    Route::group(['prefix'=>'Announcements'],function (){
        Route::get('',[AnnouncementController::class,'index']);



    });
    Route::group(['prefix'=>'Clients'],function (){
        Route::get('',[ClientController::class,'getAllClient']);
    });


    });
});

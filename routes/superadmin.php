<?php
use App\Http\Controllers\AdministratorController;
Route::group([],function() {
    Route::post('register', [AdministratorController::class, 'registerSuperAdmin']);
    Route::post('login', [AdministratorController::class, 'login']);
    Route::group(['middleware'=>'superadmin'],function (){
        Route::post('logout', [AdministratorController::class, 'logout']);
        Route::post('me', [AdministratorController::class, 'me']);
        Route::group(['prefix'=>'Admins'],function (){
            Route::post('register',[AdministratorController::class,'register']);
            Route::put('update/{id}',[AdministratorController::class,'Update']);
            Route::delete('delete/{id}',[AdministratorController::class,'DeleteAdmin']);


        });
});
});

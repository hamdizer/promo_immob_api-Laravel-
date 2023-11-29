<?php
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientController;
Route::group([],function() {
    Route::post('register', [CorporateController::class, 'registerManager']);
    Route::post('login', [CorporateController::class, 'login']);
    Route::group(['middleware'=>'manager'],function (){
        Route::post('logout', [CorporateController::class, 'logout']);
        Route::post('me', [CorporateController::class, 'me']);
    Route::group(['prefix'=>'Corporates'],function (){
        Route::post('register',[CorporateController::class,'register']);
        Route::put('update/{id}',[CorporateController::class,'updateCorporate']);
        Route::delete('delete/{id}',[CorporateController::class,'deleteCorporate']);
    });
    Route::group(['prefix'=>'Invoices'],function (){
        Route::get('',[InvoiceController::class,'getInvoicesByCorporate']);
    });
        Route::group(['prefix' => 'Clients'], function () {
            Route::get('', [ClientController::class, 'getClientsByCorporate']);
        });
    });
});

<?php
use App\Http\Controllers\ClientController;
use \App\Http\Controllers\AnnouncementController;
use \App\Http\Controllers\InvoiceController;
use \App\Http\Controllers\ReservationController;
use \App\Http\Controllers\ContractController;
Route::group([],function() {
    Route::post('register', [ClientController::class, 'register']);
    Route::post('login', [ClientController::class, 'login']);
    Route::group(['middleware'=>'client'],function (){
        Route::post('logout', [ClientController::class, 'logout']);
        Route::post('me', [CLientController::class, 'me']);
        Route::group(['prefix'=>'Announcements'],function (){
            Route::post('reserve/{id}',[AnnouncementController::class,'reserveAnnouncement']);
        });
        Route::group(['prefix'=>'Reservations'],function (){
            Route::get('',[ReservationController::class,'getReservationByClient']);
        });
        Route::group(['prefix'=>'Invoices'],function (){
            Route::get('',[InvoiceController::class,'getInvoicesByClients']);
            Route::post('/pay/{id}',[InvoiceController::class,'pay']);

        });
        Route::group(['prefix'=>'Contracts'],function (){
            Route::get('',[ContractController::class,'getContractByClient']);
        });
        Route::group(['prefix'=>'Agencies'],function (){
            Route::post('choice/{id}',[ClientController::class,'choiceAgency']);
        });
    });

});

<?php
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\AnnouncementController;
use \App\Http\Controllers\ClientController;
use \App\Http\Controllers\ReservationController;

Route::group([],function() {
    Route::post('register', [CorporateController::class, 'register']);
    Route::post('login', [CorporateController::class, 'login']);
    Route::group(['middleware' => 'corporate'], function () {
        Route::post('logout', [CorporateController::class, 'logout']);
        Route::post('me', [CorporateController::class, 'me']);
        Route::group(['prefix' => 'Announcements'], function () {
            Route::get('', [AnnouncementController::class, 'index']);
            Route::post('', [AnnouncementController::class, 'store']);
            Route::post('update/{id}', [AnnouncementController::class, 'updateAnnouncement']);
            Route::delete('delete/{id}', [AnnouncementController::class, 'destroy']);
            Route::put('accept/{id}', [ReservationController::class, 'acceptReservation']);
            Route::put('reject/{id}', [ReservationController::class, 'rejectReservation']);

        });
        Route::group(['prefix' => 'Reservations'], function () {
            Route::get('', [ReservationController::class, 'getReservationByCorporate']);
        });
        Route::group(['prefix' => 'Clients'], function () {
            Route::get('', [ClientController::class, 'getClientsByCorporate']);
        });
       /* Route::group(['prefix' => 'Invoices'], function () {
            Route::get('', [InvoiceController::class, 'getInvoicesByCorporate']);
        });*/
    });
});

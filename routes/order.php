<?php

    use App\Http\Controllers\Order\NewOrderController;
    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => 'verified'], function () {
        Route::get('/show-page', [NewOrderController::class, 'showPage'])
            ->middleware('delete.orders')
            ->name('showPage');

        Route::post('/create-order', [NewOrderController::class, 'createNewOrder'])
            ->name('createOrder');

        Route::get('/add-executor', [NewOrderController::class, 'addExecutorToNewOrder'])
            ->name('addExecutor');

        Route::get('/executor/{id}', [NewOrderController::class, 'selectedExecutor'])
            ->name('selectedExecutor');
    });

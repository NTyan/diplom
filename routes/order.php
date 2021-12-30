<?php

    use App\Http\Controllers\Order\NewOrderController;
    use Illuminate\Support\Facades\Route;

    Route::get('/show-page', [NewOrderController::class, 'showPage'])
        ->middleware('verified')
        ->name('showPage');

    Route::post('/create-order', [NewOrderController::class, 'createNewOrder'])
        ->middleware('verified')
        ->name('createOrder');

    Route::get('/add-executor', [NewOrderController::class, 'addExecutorToNewOrder'])
        ->middleware('verified')
        ->name('addExecutor');

    Route::get('/executor/{id}', [NewOrderController::class, 'selectedExecutor'])
        ->middleware('verified')
        ->name('selectedExecutor');

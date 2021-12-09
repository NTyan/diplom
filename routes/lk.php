<?php

    use App\Http\Controllers\lk\OrdersController;
    use App\Http\Controllers\lk\OrgController;
    use Illuminate\Support\Facades\Route;

    Route::get('/business', [OrgController::class, 'show'])->middleware('verified')->name('orgs');
    Route::get('/orders', [OrdersController::class, 'show'])->middleware('verified')->name('orders');
    Route::get('/orders/{id}', [OrdersController::class, 'order'])->middleware('verified')->name('order');
    Route::get('/organization/{id}', [OrgController::class, 'organization'])->middleware('verified')->name('org');

<?php

    use App\Http\Controllers\lk\OrdersController;
    use App\Http\Controllers\lk\OrgController;
    use Illuminate\Support\Facades\Route;

    Route::get('/business', [OrgController::class, 'show'])
        ->middleware('verified')
        ->name('orgs');

    Route::get('/orders', [OrdersController::class, 'show'])
        ->middleware('verified')
        ->name('orders');

    Route::get('/org-orders/{id}', [OrgController::class, 'showOrders'])
        ->middleware('verified')
        ->name('orgOrders');

    Route::get('/orders/{id}', [OrdersController::class, 'order'])
        ->middleware('verified')
        ->name('order');

    Route::get('/organization/{id}', [OrgController::class, 'organization'])
        ->middleware('verified')
        ->name('org');

    Route::get('/delete-plastic/{id}', [OrgController::class, 'deletePlastic'])
        ->middleware('verified');

    Route::post('/edit-info', [OrgController::class, 'editInfo'])
        ->middleware('verified');

    Route::get('/delete-org/{id}', [OrgController::class, 'deleteOrganization'])
        ->middleware('verified');

    Route::post('/edit-price', [OrgController::class, 'editPrice'])
        ->middleware('verified');

    Route::post('/order-status-paid', [OrdersController::class, 'changeOrderStatusPaid'])
        ->middleware('verified');

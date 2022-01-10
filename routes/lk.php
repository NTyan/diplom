<?php

    use App\Http\Controllers\lk\ChatController;
    use App\Http\Controllers\lk\OrdersController;
    use App\Http\Controllers\lk\OrgController;
    use App\Http\Controllers\lk\ProfileController;
    use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'verified'], function () {


    Route::get('/delete-plastic/{id}', [OrgController::class, 'deletePlastic']);

    Route::post('/edit-info', [OrgController::class, 'editInfo']);

    Route::post('/add-new-org', [OrgController::class, 'addNewOrg']);
    Route::post('/add-new-price', [OrgController::class, 'addNewPrice']);

    Route::get('/delete-org/{id}', [OrgController::class, 'deleteOrganization']);

    Route::post('/edit-price', [OrgController::class, 'editPrice']);

    Route::post('/order-status-paid', [OrdersController::class, 'changeOrderStatusPaid']);
    Route::post('/order-status-canceled', [OrdersController::class, 'changeOrderStatusCanceled']);
    Route::post('/order-status-transit', [OrdersController::class, 'changeOrderStatusTransit']);
    Route::post('/order-status-completed', [OrdersController::class, 'changeOrderStatusCompleted']);

    Route::get('/file/{order_id}/{model_id}', [OrdersController::class, 'downloadFile']);

    Route::post('/get-messages', [ChatController::class, 'getMessages']);

    Route::post('/send-message', [ChatController::class, 'sendMessage']);


    Route::group(['middleware' => 'delete.orders'], function () {

        Route::get('/business', [OrgController::class, 'show'])
            ->name('orgs');

        Route::get('/orders', [OrdersController::class, 'show'])
            ->name('orders');

        Route::get('/org-orders/{id}', [OrgController::class, 'showOrders'])
            ->name('orgOrders');

        Route::get('/orders/{id}', [OrdersController::class, 'order'])
            ->name('order');

        Route::get('/organization/{id}', [OrgController::class, 'organization'])
            ->name('org');

    });
});

Route::get('/delete-account', [ProfileController::class, 'deleteAccount'])
->middleware('auth');

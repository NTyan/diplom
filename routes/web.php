<?php

    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\lk\OrgController;
    use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'show'])->name('home')->middleware('delete.orders');

Route::get('/profile', function () {
    return view('lk.profile');
})->middleware(['auth', 'delete.orders'])->name('profile');

require __DIR__.'/auth.php';
require __DIR__.'/lk.php';
require __DIR__.'/order.php';

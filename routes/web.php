<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VoucherController;
use App\Models\Transaction;
use App\Models\Voucher;
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

Route::get('/', [AdminController::class, 'redirect']);

Route::get('/login', [AdminController::class, 'login'])->name('login')->middleware("guest");
Route::post('/login', [AdminController::class, 'loginUser']);

Route::get('/register', [RegisterController::class, 'register'])->middleware("guest");
Route::post('/register', [RegisterController::class, 'registerUser']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    });

    Route::get('/product', [ProductController::class, 'products']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/create', [ProductController::class, 'productsCreate']);
    Route::get('/product/edit/{products:id}', [ProductController::class, 'showEdit']);
    Route::post('/product/edit/{products:id}', [ProductController::class, 'productsEdit']);
    Route::get('/product/delete/{products:id}', [ProductController::class, 'productsDelete']);

    Route::get('/categories', [CategorieController::class, 'categories']);
    Route::get('/categories/create', [CategorieController::class, 'create']);
    Route::post('/categories/create', [CategorieController::class, 'categoriesCreate']);
    Route::get('/categories/edit/{product_categories:id}', [CategorieController::class, 'showEdit']);
    Route::post('/categories/edit/{product_categories:id}', [CategorieController::class, 'categoriesEdit']);
    Route::get('/categories/delete/{product_categories:id}', [CategorieController::class, 'categoriesDelete']);

    Route::get('/voucher', [VoucherController::class, 'voucher']);
    Route::get('/voucher/create', [VoucherController::class, 'create']);
    Route::post('/voucher/create', [VoucherController::class, 'voucherCreate']);
    Route::get('/voucher/edit/{vouchers:id}', [VoucherController::class, 'showEdit']);
    Route::post('/voucher/edit/{vouchers:id}', [VoucherController::class, 'voucherEdit']);
    Route::get('/voucher/delete/{vouchers:id}', [VoucherController::class, 'voucherDelete']);

    Route::get('/transaction', [TransactionController::class, 'transaction']);
    Route::get('/transaction/create', [TransactionController::class, 'create']);
    Route::post('/transaction/create', [TransactionController::class, 'transactionCreate']);
    Route::post('/transaction/product_price', [ProductController::class, 'getPrice']);
    Route::post('/transaction/voucher_use', [VoucherController::class, 'useVoucher']);
    Route::get('/transaction/edit/{transactions:id}', [TransactionController::class, 'showEdit']);
    Route::post('/transaction/edit/{transactions:id}', [TransactionController::class, 'transactionEdit']);
    Route::get('/transaction/delete/{transactions:id}', [TransactionController::class, 'transactionDelete']);

    Route::get('/auth/logout', [AdminController::class, 'logout']);
});

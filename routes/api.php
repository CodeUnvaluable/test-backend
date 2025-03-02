<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\FiatTransactionController;


Route::prefix('users')->group(function () {
    Route::get('{id}', [UserController::class, 'getUserData']);  
});

Route::prefix('orders')->group(function () {
    Route::post('create', [OrderController::class, 'createOrder']); 
    Route::get('{id}', [OrderController::class, 'getOrder']); 
    Route::get('user/{userId}', [OrderController::class, 'getUserOrders']); 
});

Route::prefix('transactions')->group(function () {
    Route::post('transfer', [TransactionController::class, 'transferCrypto']); 
    Route::get('{id}', [TransactionController::class, 'getTransaction']); 
});

Route::prefix('wallets')->group(function () {
    Route::post('add', [WalletController::class, 'addWallet']);
    Route::get('user/{userId}', [WalletController::class, 'getUserWallets']); 
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/fiat-transactions', [FiatTransactionController::class, 'index']);
    Route::post('/fiat-transactions', [FiatTransactionController::class, 'store']);
    Route::get('/fiat-transactions/{id}', [FiatTransactionController::class, 'show']);
    Route::put('/fiat-transactions/{id}', [FiatTransactionController::class, 'update']);
    Route::delete('/fiat-transactions/{id}', [FiatTransactionController::class, 'destroy']);
});
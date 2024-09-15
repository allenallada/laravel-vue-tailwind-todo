<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ValidateTodo;
use App\Http\Middleware\ValidateTodoExists;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidateLogin;
use App\Http\Middleware\ValidateRegister;

Route::prefix('todos')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [TodoController::class, 'index']);
    Route::post('/', [TodoController::class, 'create'])->middleware(ValidateTodo::class);
    Route::put('/{id}', [TodoController::class, 'update'])->middleware([ValidateTodo::class, ValidateTodoExists::class]);
    Route::delete('/{id}', [TodoController::class, 'delete'])->middleware([ValidateTodoExists::class]);
});

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [UserController::class, 'index']);
});

Route::post('login', [AuthController::class, 'login'])->middleware(ValidateLogin::class);
Route::post('/register', [AuthController::class, 'register'])->middleware(ValidateRegister::class);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;
use App\Http\Middleware\ValidateTodo;
use App\Http\Middleware\ValidateTodoExists;
use App\Http\Middleware\ValidateUpdateTodo;

Route::prefix('todos')->group(function () {
    Route::get('/', [TodoController::class, 'index']);
    Route::post('/', [TodoController::class, 'create'])->middleware(ValidateTodo::class);
    Route::put('/{id}', [TodoController::class, 'update'])->middleware([ValidateUpdateTodo::class, ValidateTodoExists::class]);
    Route::delete('/{id}', [TodoController::class, 'delete'])->middleware([ValidateTodoExists::class]);
});
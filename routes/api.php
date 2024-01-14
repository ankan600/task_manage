<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\LoginController;

// Route::group(['middleware'=>['auth:sanctum']], function () {
//     Route::match(['post','get'], 'add-task', [TaskController::class, 'add_task']);
// });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['admin_auth'])->group(function () {
        Route::match(['post','get'], 'add-task', [TaskController::class, 'add_task']);
        Route::match(['post','get'], 'edit-task', [TaskController::class, 'edit_task']);
        Route::match(['post','get'], 'delete-task', [TaskController::class, 'delete_task']);
    });

    Route::match(['post','get'], 'get-task', [TaskController::class, 'get_task']);
    Route::match(['post','get'], 'get-task/{user_id}', [TaskController::class, 'get_task']);
    Route::match(['post','get'], 'change-task-status', [TaskController::class, 'change_task_status']);

    Route::match(['post','get'], 'get-single-task/{task_id}', [TaskController::class, 'get_single_task']);
    Route::match(['post','get'], 'get-emplyee', [LoginController::class, 'get_emplyee']);
    Route::match(['post','get'], 'logout', [LoginController::class, 'logout']);
});



Route::match(['post','get'], 'login', [LoginController::class, 'login']);
Route::match(['post','get'], 'reg', [LoginController::class, 'reg']);

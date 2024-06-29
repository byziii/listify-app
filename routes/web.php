<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TasksController::class, 'welcome']);
Route::get('/tasks', [TasksController::class, 'todo']);
Route::get('/completed', [TasksController::class, 'completed']);

// API Routes for Task Management
Route::prefix('api')->group(function () {
    Route::get('/tasks', [TasksController::class, 'get']); // Get all tasks
    Route::post('/tasks', [TasksController::class, 'add']); // Add a new task
    Route::delete('/tasks/{id}', [TasksController::class, 'delete']); // Delete a task
    Route::put('/tasks/{id}', [TasksController::class, 'updateStatus']); // Update task status
    Route::put('/tasks/{id}/name', [TasksController::class, 'updateTaskName']); // Update task name
});

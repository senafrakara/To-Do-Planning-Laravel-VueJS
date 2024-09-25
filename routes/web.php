<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'getPlan']);

Route::get('tasks/plan-distribute-tasks', [TaskController::class, 'planAndDistributeTasks']);

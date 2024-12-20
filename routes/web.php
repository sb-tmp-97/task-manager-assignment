<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [ProjectsController::class, 'index'])
        ->name('projects.index');

    Route::resource('projects.tasks', TasksController::class)
        ->only([
            'index', 'store', 'destroy'
        ])
        ->names([
            'index' => 'projects.tasks.index',
            'store' => 'projects.tasks.store',
            'destroy' => 'projects.tasks.destroy',
        ]);
    Route::put('projects/{project}/tasks/{task}/complete', [TasksController::class, 'complete'])
        ->name('projects.tasks.complete');

});

require __DIR__.'/auth.php';

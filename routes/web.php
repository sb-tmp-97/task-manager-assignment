<?php

use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [ProjectsController::class, 'index'])->name('projects.overview');

});

require __DIR__.'/auth.php';

<?php

use App\Containers\AppSection\Timses\UI\WEB\Controllers\CardTimsesController;
use Illuminate\Support\Facades\Route;

// http://apiato.test
Route::get('timses/{id}/card', [CardTimsesController::class, 'generateCard'])
    ->name('web_timses_card');


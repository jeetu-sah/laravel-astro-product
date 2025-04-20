<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::resource('guest', GuestController::class);


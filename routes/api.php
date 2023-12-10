<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDatesController;

Route::get('/export-excel', [UserDatesController::class, 'exportExcel']);
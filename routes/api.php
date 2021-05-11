<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('teams', TeamController::class);

Route::resource('teams.members', MemberController::class);

Route::get('countries', [CountryController::class, 'index']);

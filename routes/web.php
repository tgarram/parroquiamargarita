<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/laboratorio', function () {
    return view('pages.laboratorio');
})->name('laboratorio');

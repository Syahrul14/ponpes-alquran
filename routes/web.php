<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website.home.home');
});

Route::get('/tentang/sejarah', function () {
    return view('website.about.history');
});



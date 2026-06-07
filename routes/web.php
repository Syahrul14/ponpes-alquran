<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website.home.home');
});

Route::prefix('tentang')->group(function () {
    Route::get('/sejarah', function () {
        return view('website.about.history');
    });
    Route::get('/visi-misi', function () {
        return view('website.about.visi_misi');
    });
});

Route::get('/program', function () {
    return view('website.program.program');
});

Route::get('/prestasi', function () {
    return view('website.prestasi.prestasi');
});


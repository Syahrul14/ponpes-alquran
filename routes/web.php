<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website.home.home');
});

Route::prefix('profil')->group(function () {
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

Route::get('/fasilitas', function () {
    return view('website.fasilitas.fasilitas');
});

Route::get('/informasi/berita', function () {
    return view('website.berita.berita');
});

Route::get('/informasi/berita/detail', function () {
    return view('website.berita.berita_detail');
});


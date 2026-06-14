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

Route::get('/informasi/informasi', function() {
    return view('website.informasi.informasi');
});

Route::get('/informasi/informasi/detail', function() {
    return view('website.informasi.informasi_detail');
});


Route::get('hubungi-kami', function () {
    return view('website.hubungi_kami.hubungi_kami');
});


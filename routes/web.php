<?php

use App\Http\Controllers\Website\Home\HomeController;
use App\Http\Controllers\Website\About\History\HistoryController;
use App\Http\Controllers\Website\About\Visi_Misi\VisiMisiController;
use App\Http\Controllers\Website\Program\ProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::prefix('profil')->group(function () {
    Route::get('/sejarah', [HistoryController::class, 'index'])->name('website.about.history');
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('website.about.visi_misi');
});

Route::get('/program', [ProgramController::class, 'index'])->name('website.program');

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

Route::get('/informasi/infaq', function () {
    return view('website.infaq.infaq');
});


Route::get('hubungi-kami', function () {
    return view('website.hubungi_kami.hubungi_kami');
});


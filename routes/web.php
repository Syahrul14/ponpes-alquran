<?php

use App\Http\Controllers\Website\Home\HomeController;
use App\Http\Controllers\Website\About\History\HistoryController;
use App\Http\Controllers\Website\About\Visi_Misi\VisiMisiController;
use App\Http\Controllers\Website\Program\ProgramController;
use App\Http\Controllers\Website\Prestasi\PrestasiController;
use App\Http\Controllers\Website\Fasilitas\FasilitasController;
use App\Http\Controllers\Website\News\NewsController as WebsiteNewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::prefix('profil')->group(function () {
    Route::get('/sejarah', [HistoryController::class, 'index'])->name('website.about.history');
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('website.about.visi_misi');
});

Route::get('/program', [ProgramController::class, 'index'])->name('website.program');

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('website.prestasi');

Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('website.fasilitas');

Route::get('/informasi/berita', [WebsiteNewsController::class, 'index'])->name('website.berita');
Route::get('/informasi/berita/{slug}', [WebsiteNewsController::class, 'detail'])->name('website.berita.detail');

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


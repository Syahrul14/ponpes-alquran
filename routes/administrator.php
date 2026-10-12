<?php

use App\Http\Controllers\Administrator\Home\HomeBannerController;
use App\Http\Controllers\Administrator\Home\HomeProfileController;
use App\Http\Controllers\Administrator\Home\HomeAlumniController;
use App\Http\Controllers\Administrator\About\History\HistoryBannerController;
use App\Http\Controllers\Administrator\About\History\HistoryProfileController;
use App\Http\Controllers\Administrator\About\Visi_Misi\VisiController;
use App\Http\Controllers\Administrator\About\Visi_Misi\MisiController;
use App\Http\Controllers\Administrator\Page_Banner\PageBannerController;
use App\Http\Controllers\Administrator\Academic\Program\ProgramCardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::prefix('administrator')->group(function () {

  Route::get('/', function () {
    return redirect()->route('administrator.login');
  });

  Route::get('/login', function () {
    return view('administrator.login');
  })->name('administrator.login');

  Route::post('/login', function (Request $request) {

    $request->validate([
      'username' => ['required', 'string'],
      'password' => ['required', 'string'],
    ]);

    $login = $request->input('username');
    $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    if (Auth::attempt([$fieldType => $login, 'password' => $request->password])) {

      $request->session()->regenerate();

      return redirect()->route('administrator.dashboard');
    }

    return back()->withErrors([
      'username' => 'Username atau password salah.',
    ])->onlyInput('username');
  })->name('administrator.login.submit');

  Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
      return view('administrator.layout');
    })->name('administrator.dashboard');

      Route::prefix('home-banner')->group(function () {
        Route::get('/', [HomeBannerController::class, 'getData'])->name('admin.home_banner.getData');
        Route::post('/store', [HomeBannerController::class, 'store'])->name('admin.home_banner.store');
        Route::put('/update/{id}', [HomeBannerController::class, 'update'])->name('admin.home_banner.update');
        Route::delete('/delete/{id}', [HomeBannerController::class, 'delete'])->name('admin.home_banner.delete');
      });

      Route::prefix('home-profile')->group(function () {
        Route::get('/', [HomeProfileController::class, 'getData'])->name('admin.home_profile.getData');
        Route::post('/store', [HomeProfileController::class, 'store'])->name('admin.home_profile.store');
        Route::put('/update/{id}', [HomeProfileController::class, 'update'])->name('admin.home_profile.update');
        Route::delete('/delete/{id}', [HomeProfileController::class, 'delete'])->name('admin.home_profile.delete');
      });

      Route::prefix('home-alumni')->group(function () {
        Route::get('/', [HomeAlumniController::class, 'getData'])->name('admin.home_alumni.getData');
        Route::post('/store', [HomeAlumniController::class, 'store'])->name('admin.home_alumni.store');
        Route::put('/update/{id}', [HomeAlumniController::class, 'update'])->name('admin.home_alumni.update');
        Route::delete('/delete/{id}', [HomeAlumniController::class, 'delete'])->name('admin.home_alumni.delete');
      });

      Route::prefix('history-banner')->group(function () {
        Route::get('/', [HistoryBannerController::class, 'getData'])->name('admin.history_banner.getData');
        Route::post('/store', [HistoryBannerController::class, 'store'])->name('admin.history_banner.store');
        Route::put('/update/{id}', [HistoryBannerController::class, 'update'])->name('admin.history_banner.update');
        Route::delete('/delete/{id}', [HistoryBannerController::class, 'delete'])->name('admin.history_banner.delete');
      });

      Route::prefix('history-profile')->group(function () {
        Route::get('/', [HistoryProfileController::class, 'getData'])->name('admin.history_profile.getData');
        Route::post('/store', [HistoryProfileController::class, 'store'])->name('admin.history_profile.store');
        Route::put('/update/{id}', [HistoryProfileController::class, 'update'])->name('admin.history_profile.update');
        Route::delete('/delete/{id}', [HistoryProfileController::class, 'delete'])->name('admin.history_profile.delete');
      });

      Route::prefix('visi')->group(function () {
        Route::get('/', [VisiController::class, 'getData'])->name('admin.visi.getData');
        Route::post('/store', [VisiController::class, 'store'])->name('admin.visi.store');
        Route::put('/update/{id}', [VisiController::class, 'update'])->name('admin.visi.update');
        Route::delete('/delete/{id}', [VisiController::class, 'delete'])->name('admin.visi.delete');
      });

      Route::prefix('misi')->group(function () {
        Route::get('/', [MisiController::class, 'getData'])->name('admin.misi.getData');
        Route::post('/store', [MisiController::class, 'store'])->name('admin.misi.store');
        Route::put('/update/{id}', [MisiController::class, 'update'])->name('admin.misi.update');
        Route::delete('/delete/{id}', [MisiController::class, 'delete'])->name('admin.misi.delete');
      });

      Route::prefix('page-banner')->group(function () {
        Route::get('/', [PageBannerController::class, 'getData'])->name('admin.page_banner.getData');
        Route::post('/store', [PageBannerController::class, 'store'])->name('admin.page_banner.store');
        Route::put('/update/{id}', [PageBannerController::class, 'update'])->name('admin.page_banner.update');
        Route::delete('/delete/{id}', [PageBannerController::class, 'delete'])->name('admin.page_banner.delete');
      });

      Route::prefix('program-card')->group(function () {
        Route::get('/', [ProgramCardController::class, 'getData'])->name('admin.program_card.getData');
        Route::post('/store', [ProgramCardController::class, 'store'])->name('admin.program_card.store');
        Route::put('/update/{id}', [ProgramCardController::class, 'update'])->name('admin.program_card.update');
        Route::delete('/delete/{id}', [ProgramCardController::class, 'delete'])->name('admin.program_card.delete');
      });

    Route::post('/logout', function (Request $request) {
      Auth::logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect()->route('administrator.login');
    })->name('administrator.logout');
  });
});

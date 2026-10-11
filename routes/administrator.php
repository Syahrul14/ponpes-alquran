<?php

use App\Http\Controllers\Administrator\Home\HomeBannerController;
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

    Route::post('/logout', function (Request $request) {
      Auth::logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect()->route('administrator.login');
    })->name('administrator.logout');
  });
});

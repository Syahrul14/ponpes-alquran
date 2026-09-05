<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::prefix('administrator')->group(function () {

  Route::get('/login', function () {
    return view('administrator.login');
  })->name('administrator.login');

  Route::post('/login', function (Request $request) {

    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {

      $request->session()->regenerate();

      return redirect()->route('administrator.dashboard');
    }

    return back()->withErrors([
      'email' => 'Email atau password salah.',
    ])->onlyInput('email');
  })->name('administrator.login.submit');

  Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
      return view('administrator.layout');
    })->name('administrator.dashboard');
  });
});

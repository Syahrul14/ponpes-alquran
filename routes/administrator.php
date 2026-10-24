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
use App\Http\Controllers\Administrator\Academic\Prestasi\PrestasiCardController;
use App\Http\Controllers\Administrator\Facility\FasilitasCardController;
use App\Http\Controllers\Administrator\Information\News\NewsController as AdminNewsController;
use App\Http\Controllers\Administrator\Information\Informasi\InformasiController as AdminInformasiController;
use App\Http\Controllers\Administrator\Infaq\InfaqBankTransferController;
use App\Http\Controllers\Administrator\Infaq\InfaqQrisController;
use App\Http\Controllers\Administrator\Contact\ContactMessageController;
use App\Http\Controllers\Administrator\Contact\ContactInfoController;
use App\Http\Controllers\Administrator\Setting\FooterSettingController;
use App\Http\Controllers\Administrator\Management\AdminManagementController;
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

      Route::prefix('prestasi-card')->group(function () {
        Route::get('/', [PrestasiCardController::class, 'getData'])->name('admin.prestasi_card.getData');
        Route::post('/store', [PrestasiCardController::class, 'store'])->name('admin.prestasi_card.store');
        Route::put('/update/{id}', [PrestasiCardController::class, 'update'])->name('admin.prestasi_card.update');
        Route::delete('/delete/{id}', [PrestasiCardController::class, 'delete'])->name('admin.prestasi_card.delete');
      });

      Route::prefix('fasilitas-card')->group(function () {
        Route::get('/', [FasilitasCardController::class, 'getData'])->name('admin.fasilitas_card.getData');
        Route::post('/store', [FasilitasCardController::class, 'store'])->name('admin.fasilitas_card.store');
        Route::put('/update/{id}', [FasilitasCardController::class, 'update'])->name('admin.fasilitas_card.update');
        Route::delete('/delete/{id}', [FasilitasCardController::class, 'delete'])->name('admin.fasilitas_card.delete');
      });

      Route::prefix('news')->group(function () {
        Route::get('/', [AdminNewsController::class, 'getData'])->name('admin.news.getData');
        Route::post('/store', [AdminNewsController::class, 'store'])->name('admin.news.store');
        Route::put('/update/{id}', [AdminNewsController::class, 'update'])->name('admin.news.update');
        Route::delete('/delete/{id}', [AdminNewsController::class, 'delete'])->name('admin.news.delete');
      });

      Route::prefix('informasi')->group(function () {
        Route::get('/', [AdminInformasiController::class, 'getData'])->name('admin.informasi.getData');
        Route::post('/store', [AdminInformasiController::class, 'store'])->name('admin.informasi.store');
        Route::put('/update/{id}', [AdminInformasiController::class, 'update'])->name('admin.informasi.update');
        Route::delete('/delete/{id}', [AdminInformasiController::class, 'delete'])->name('admin.informasi.delete');
      });

      Route::prefix('infaq-bank')->group(function () {
        Route::get('/', [InfaqBankTransferController::class, 'getData'])->name('admin.infaq_bank.getData');
        Route::post('/store', [InfaqBankTransferController::class, 'store'])->name('admin.infaq_bank.store');
        Route::put('/update/{id}', [InfaqBankTransferController::class, 'update'])->name('admin.infaq_bank.update');
        Route::delete('/delete/{id}', [InfaqBankTransferController::class, 'delete'])->name('admin.infaq_bank.delete');
      });

      Route::prefix('infaq-qris')->group(function () {
        Route::get('/', [InfaqQrisController::class, 'getData'])->name('admin.infaq_qris.getData');
        Route::post('/update', [InfaqQrisController::class, 'update'])->name('admin.infaq_qris.update');
      });

      Route::prefix('informasi-kontak')->group(function () {
        Route::get('/', [ContactInfoController::class, 'getData'])->name('admin.contact_info.getData');
        Route::post('/update', [ContactInfoController::class, 'update'])->name('admin.contact_info.update');
      });

      Route::prefix('pesan-masuk')->group(function () {
        Route::get('/', [ContactMessageController::class, 'getData'])->name('admin.contact_messages.getData');
        Route::post('/read/{id}', [ContactMessageController::class, 'markAsRead'])->name('admin.contact_messages.markAsRead');
        Route::delete('/delete/{id}', [ContactMessageController::class, 'delete'])->name('admin.contact_messages.delete');
      });

      Route::prefix('pengaturan-web')->group(function () {
        Route::get('/', [FooterSettingController::class, 'getData'])->name('admin.footer_setting.getData');
        Route::post('/update', [FooterSettingController::class, 'update'])->name('admin.footer_setting.update');

        Route::prefix('social-media')->group(function () {
          Route::post('/store', [FooterSettingController::class, 'storeSocialMedia'])->name('admin.footer_setting.social_media.store');
          Route::post('/update/{id}', [FooterSettingController::class, 'updateSocialMedia'])->name('admin.footer_setting.social_media.update');
          Route::delete('/delete/{id}', [FooterSettingController::class, 'deleteSocialMedia'])->name('admin.footer_setting.social_media.delete');
        });
      });

      Route::prefix('manajemen-admin')->group(function () {
        Route::get('/', [AdminManagementController::class, 'getData'])->name('admin.management.getData');
        Route::post('/store', [AdminManagementController::class, 'store'])->name('admin.management.store');
        Route::put('/update/{id}', [AdminManagementController::class, 'update'])->name('admin.management.update');
        Route::delete('/delete/{id}', [AdminManagementController::class, 'delete'])->name('admin.management.delete');
      });

    Route::post('/logout', function (Request $request) {
      Auth::logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect()->route('administrator.login');
    })->name('administrator.logout');
  });
});

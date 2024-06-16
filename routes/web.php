<?php

use App\Http\Controllers\MahasiswaCheckController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/register','/login');

/**
 * Frontend Namespace
 */

Route::middleware('guest')->group(function(){
    Route::get('/check-mahasiswa',[MahasiswaCheckController::class,'checkMahasiswa'])->name('check.mahasiswa');
    Route::post('/check-email', [MahasiswaCheckController::class,'checkEmail'])->name('check.email');
    Route::get('/otp/{mahasiswa}', [MahasiswaCheckController::class,'OtpView'])->name('otp.view');
    Route::post('/otp/check', [MahasiswaCheckController::class,'OtpCheck'])->name('otp.check');
});

Route::middleware('guest')->namespace('App\Livewire\Frontend')->group(function () {
    Route::get('/', Home\Index::class)->name('frontend.home');
});

Route::middleware('auth','roles:user')->namespace('App\Livewire\Frontend')->group(function(){
    Route::namespace('Service')->prefix('pelayanan-mahasiswa')->name('service-mahasiswa.')->group(function(){
        Route::get('/upload-berkas', UploadBerkas::class)->name('upload-berkas');
    });
});

Route::middleware('auth', 'verified', 'force.logout', 'roles:admin')->namespace('App\Livewire')->group(function () {
    /**
     * beranda / home
     */
    Route::get('beranda', Home\Index::class)->name('home')
        ->middleware('roles:admin');

    /**
     * mahasiswa
     */
    Route::namespace('Mahasiswa')->name('mahasiswa.')->prefix('mahasiswa')->middleware('roles:admin')->group(function(){
        Route::get('/', Index::class)->name('index');
        Route::get('/tambah', Create::class)->name('create');
        Route::get('/sunting/{id}', Edit::class)->name('edit');
        Route::get('/detail/{id}', Detail::class)->name('detail');
    });

    /**
     * pengguna
     */
    Route::namespace('Pengguna')->prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/tambah', Create::class)->name('create');
        Route::get('/sunting/{id}', Edit::class)->name('edit');
    });

    /**
     * berkas
     */
    Route::namespace('Berkas')->prefix('berkas-mahasiswa')->name('berkas.')->group(function () {
        Route::redirect('/', 'berkas/proposal');

        Route::namespace('Proposal')->prefix('proposal')->name('proposal.')->group(function(){
            Route::get('/', Index::class)->name('index');
            Route::get('/revisi/{id}', Revision::class)->name('revision');
        });

        Route::namespace('Hasil')->prefix('hasil')->name('hasil.')->group(function(){
            Route::get('/', Index::class)->name('index');
            Route::get('/revisi/{id}', Revision::class)->name('revision');
        });

        Route::namespace('Tutup')->prefix('tutup')->name('tutup.')->group(function(){
            Route::get('/', Index::class)->name('index');
            Route::get('/revisi/{id}', Revision::class)->name('revision');
        });
    });

    /**
     * revision / revisi
     */
    Route::namespace('Revision')->prefix('revisi-berkas')->name('revision.')->group(function () {
        Route::redirect('/', 'revisi-berkas/proposal');

        Route::namespace('Proposal')->prefix('proposal')->name('proposal.')->group(function(){
            Route::get('/', Index::class)->name('index');
            Route::get('/sunting/{id}', Edit::class)->name('edit');
        });

        Route::namespace('Hasil')->prefix('hasil')->name('hasil.')->group(function(){
            Route::get('/', Index::class)->name('index');
            Route::get('/sunting/{id}', Edit::class)->name('edit');
        });

        Route::namespace('Tutup')->prefix('tutup')->name('tutup.')->group(function(){
            Route::get('/', Index::class)->name('index');
            Route::get('/sunting/{id}', Edit::class)->name('edit');
        });

    });

    /**
     * setting
     */
    Route::prefix('pengaturan')->name('setting.')->middleware('roles:admin,user')->namespace('Setting')->group(function () {
        Route::redirect('/', 'pengaturan/aplikasi');

        /**
         * Profile
         */
        Route::prefix('profil')->name('profile.')->group(function () {
            Route::get('/', Profile\Index::class)->name('index');
        });

        /**
         * Account
         */
        Route::prefix('akun')->name('account.')->group(function () {
            Route::get('/', Account\Index::class)->name('index');
        });
    });
});

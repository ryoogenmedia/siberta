<?php

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

Route::redirect('/', '/login');

Route::get('/lading-page', function () {
    return view('layouts/base-frontend');
});


Route::middleware('auth', 'verified', 'force.logout')->namespace('App\Livewire')->group(function () {
    /**
     * beranda / home
     */
    Route::get('beranda', Home\Index::class)->name('home')
        ->middleware('roles:admin,user');

    /**
     * mahasiswa
     */
    Route::namespace('Mahasiswa')->name('mahasiswa.')->prefix('mahasiswa')->middleware('roles:admin')->group(function(){
        Route::get('/', Index::class)->name('index');
        Route::get('/tambah', Create::class)->name('create');
        Route::get('/sunting/{id}', Edit::class)->name('edit');
    });

    /**
     * pengguna
     */
    Route::namespace('Pengguna')->prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/tambah', Create::class)->name('create');
        Route::get('/{id}/sunting', Edit::class)->name('edit');
    });

    /**
     * berkas
     */
    Route::namespace('Berkas')->prefix('berkas-mahasiswa')->name('berkas.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/{id}/revisi', Revision::class)->name('revision');
    });

    /**
     * revision / revisi
     */
    Route::namespace('Revision')->prefix('revisi-berkas')->name('revision.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/{id}/sunting', Edit::class)->name('edit');
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

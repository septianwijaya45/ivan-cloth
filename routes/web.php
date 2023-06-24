<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KainPotonganController;
use App\Http\Controllers\KainRollController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangJadiController;
use App\Http\Controllers\FilmSablonController;
use App\Http\Controllers\FinishingController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JahitController;
use App\Http\Controllers\PemasukkanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PerlengkapanController;
use App\Http\Controllers\SPKController;
use App\Http\Controllers\SPPController;
use App\Http\Controllers\TransaksiGajiController;
use App\Http\Controllers\UkuranController;
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

Route::get('/', function () {
    return redirect()->route('loginpage');
});

Route::get('login', [LoginController::class, 'index'])->name('loginpage');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['web', 'auth', 'roles']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ***** OWNER ROLE ***** //
    Route::group(['roles' => 'Owner'], function () {
        // Module Ukuran
        Route::group(['prefix' => 'ukuran'], function () {
            Route::get('', [UkuranController::class, 'index'])->name('ukuran');
            Route::get('data', [UkuranController::class, 'indexData'])->name('ukuran.data');
            Route::post('', [UkuranController::class, 'store'])->name('ukuran.add');
            Route::get('{uuid}', [UkuranController::class, 'edit'])->name('ukuran.edit');
            Route::put('{uuid}', [UkuranController::class, 'update'])->name('ukuran.update');
            Route::delete('{uuid}', [UkuranController::class, 'delete'])->name('ukuran.delete');
        });

        // Module Gaji
        Route::group(['prefix' => 'gaji'], function () {
            Route::get('', [GajiController::class, 'index'])->name('gaji');
            Route::get('data', [GajiController::class, 'indexData'])->name('gaji.data');
            Route::post('', [GajiController::class, 'store'])->name('gaji.add');
            Route::get('{uuid}', [GajiController::class, 'edit'])->name('gaji.edit');
            Route::put('{uuid}', [GajiController::class, 'update'])->name('gaji.update');
            Route::delete('{uuid}', [GajiController::class, 'delete'])->name('gaji.delete');
        });

        //Route Module Kain Roll
        Route::group(['prefix' => 'kain-roll'], function () {
            Route::get('', [KainRollController::class, 'index'])->name('kain_roll');
            Route::get('data', [KainRollController::class, 'indexData'])->name('kain_roll.data');
            Route::post('', [KainRollController::class, 'addData'])->name('kain_roll.add');
            Route::get('{uuid}', [KainRollController::class, 'detailData'])->name('kain_roll.detail');
            Route::put('{uuid}', [KainRollController::class, 'updateData'])->name('kain_roll.update');
            Route::delete('{uuid}', [KainRollController::class, 'deleteData'])->name('kain_roll.delete');
        });

        // Route Module Kain Potongan
        Route::group(['prefix' => 'kain-potongan'], function () {
            Route::get('', [KainPotonganController::class, 'index'])->name('kain_potongan');
            Route::get('data', [KainPotonganController::class, 'indexData'])->name('kain_potongan.data');
            Route::post('', [KainPotonganController::class, 'store'])->name('kain_potongan.add');
            Route::get('{uuid}', [KainPotonganController::class, 'detail'])->name('kain_potongan.detail');
            Route::put('{uuid}', [KainPotonganController::class, 'update'])->name('kain_potongan.update');
            Route::delete('{uuid}', [KainPotonganController::class, 'delete'])->name('kain_potongan.delete');
        });

        //Route Module Karyawan
        Route::group(['prefix' => 'karyawan'], function () {
            Route::get('', [KaryawanController::class, 'index'])->name('karyawan');
            Route::get('data', [KaryawanController::class, 'indexData'])->name('karyawan.data');
            Route::post('', [KaryawanController::class, 'addData'])->name('karyawan.add');
            Route::get('{uuid}', [KaryawanController::class, 'detailData'])->name('karyawan.detail');
            Route::put('{uuid}', [KaryawanController::class, 'updateData'])->name('karyawan.update');
            Route::delete('{uuid}', [KaryawanController::class, 'deleteData'])->name('karyawan.delete');
        });

        //Route Module Perlengkapan
        Route::group(['prefix' => 'perlengkapan'], function () {
            Route::get('', [PerlengkapanController::class, 'index'])->name('perlengkapan');
            Route::get('data', [PerlengkapanController::class, 'indexData'])->name('perlengkapan.data');
            Route::post('', [PerlengkapanController::class, 'addData'])->name('perlengkapan.add');
            Route::get('{uuid}', [PerlengkapanController::class, 'detailData'])->name('perlengkapan.detail');
            Route::put('{uuid}', [PerlengkapanController::class, 'updateData'])->name('perlengkapan.update');
            Route::delete('{uuid}', [PerlengkapanController::class, 'deleteData'])->name('perlengkapan.delete');
        });

        //Route Module Aset
        Route::group(['prefix' => 'aset'], function () {
            Route::get('', [AsetController::class, 'index'])->name('aset');
            Route::get('data', [AsetController::class, 'indexData'])->name('aset.data');
            Route::post('', [AsetController::class, 'addData'])->name('aset.add');
            Route::get('{uuid}', [AsetController::class, 'detailData'])->name('aset.detail');
            Route::put('{uuid}', [AsetController::class, 'updateData'])->name('aset.update');
            Route::delete('{uuid}', [AsetController::class, 'deleteData'])->name('aset.delete');
        });

        // Route Film Sablon
        Route::group(['prefix' => 'Film-Sablon'], function () {
            Route::get('/', [FilmSablonController::class, 'index'])->name('filmSablon');
            Route::get('/get-data', [FilmSablonController::class, 'indexData'])->name('filmSablon.Data');
        });

        // Route SPP
        Route::group(['prefix' => 'surat-perintah-potong'], function () {
            Route::get('', [SPPController::class, 'index'])->name('spp');
            Route::get('data', [SPPController::class, 'indexData'])->name('spp.data');
            // create
            Route::get('tambah-data', [SPPController::class, 'insert'])->name('spp.insert');
            Route::post('tambah-data', [SPPController::class, 'store'])->name('spp.store');
            // edit
            Route::get('edit-data/{uuid}', [SPPController::class, 'edit'])->name('spp.edit');
            Route::post('edit-data', [SPPController::class, 'update'])->name('spp.update');
            // delete detail
            Route::delete('detail-data/delete/{id}', [SPPController::class, 'deleteInsertorEdit'])->name('spp.deleteInsertEdit');
            // delete spp
            Route::delete('delete/{kode_spp}', [SPPController::class, 'destroy'])->name('spp.delete');
            // Confirm & Finishing
            Route::put('confirm-work/{kode_spp}', [SPPController::class, 'confirm'])->name('spp.confirm');
            Route::put('finished-work/{kode_spp}', [SPPController::class, 'finished'])->name('spp.finished');
            // get spp for SPK
            Route::get('data/{kode_spp}', [SPPController::class, 'dataSPP'])->name('spp.getData');

            Route::get('get-data/{ukuran}', [SPPController::class, 'searchKainPotongan'])->name('spp.searchKainPotongan');
            Route::get('get-data/{ukuran}/{kode_lot}', [SPPController::class, 'searchKainPotonganStok'])->name('spp.searchKainPotonganStok');

            // Print SPP
            Route::get('print-data/{uuid}', [SPPController::class, 'cetakPdf'])->name('spp.cetakPdf');
        });

        // Route SPK
        Route::group(['prefix' => 'surat-perintah-kerja'], function () {
            // getArticle
            Route::get('artikel/{artikel}', [SPKController::class, 'getArtikel'])->name('spk.artikel');
            // get Hasil Potongan
            Route::get('hasil-potongan/{kp_id}', [SPKController::class, 'getHasilPotongan'])->name('spk.hasilPotongan');
            // index
            Route::get('', [SPKController::class, 'index'])->name('spk');
            Route::get('data', [SPKController::class, 'indexData'])->name('spk.data');
            // create
            Route::get('tambah-data', [SPKController::class, 'insert'])->name('spk.insert');
            Route::post('tambah-data', [SPKController::class, 'store'])->name('spk.store');
            // save image
            Route::post('get-gambar', [SPKController::class, 'getGambar'])->name('spk.getGambar');
            Route::post('tambah-gambar', [SPKController::class, 'storeGambar'])->name('spk.storeGambar');
            Route::post('tambah-gambar-edit', [SPKController::class, 'storeGambarEdit'])->name('spk.storeGambarEdit');

            // edit
            Route::get('edit-data/{uuid}', [SPKController::class, 'edit'])->name('spk.edit');
            Route::post('edit-data', [SPKController::class, 'update'])->name('spk.update');
            Route::post('edit-detail', [SPKController::class, 'updateDetail'])->name('spk.updateDetail');
            // delete detail
            Route::delete('detail-data/delete/{id}', [SPKController::class, 'deleteInsertorEdit'])->name('spk.deleteInsertEdit');
            // delete spk
            Route::delete('delete/{kode_spk}', [SPKController::class, 'destroy'])->name('spk.delete');
            // delete gambar
            Route::delete('delete-gambar-spk/{uuid}', [SPKController::class, 'destroyImage'])->name('spk.deleteImage');
            Route::delete('delete-gambar-spk/{kode_spk}/{artikel}', [SPKController::class, 'destroyBySpkArtikelImage'])->name('spk.deleteBySPKArtikelGambar');
            // delete detail SPK
            Route::delete('delete-detail-spk/{id}', [SPKController::class, 'destroyDetail'])->name('spk.deleteDetail');

            // Confirm & Finishing
            Route::put('confirm-work/{kode_spk}', [SPKController::class, 'confirm'])->name('spk.confirm');
            Route::put('finished-work/{kode_spk}', [SPKController::class, 'finished'])->name('spk.finished');

            // Print SPK
            Route::get('print-data/{uuid}', [SPKController::class, 'cetakPdf'])->name('spk.cetakPdf');
        });

        // Route Jahit
        Route::group(['prefix' => 'jahit'], function () {
            // get artikel spk
            Route::get('getArtikelFromSPK/{kode_spk}', [JahitController::class, 'getArtikelFromSPK'])->name('getArtikelSpk');
            Route::get('getQuantityArtikel/{id}', [JahitController::class, 'getQuantityArtikel'])->name('getQuantityArtikel');
            // index
            Route::get('', [JahitController::class, 'index'])->name('jahit');
            Route::get('data/{status}', [JahitController::class, 'indexData'])->name('jahit.data');
            // create
            Route::get('tambah-data', [JahitController::class, 'insert'])->name('jahit.insert');
            Route::post('tambah-data', [JahitController::class, 'store'])->name('jahit.store');
            // edit
            Route::get('edit-data/{uuid}', [JahitController::class, 'edit'])->name('jahit.edit');
            Route::post('edit-data', [JahitController::class, 'update'])->name('jahit.update');
            Route::post('edit-detail', [JahitController::class, 'updateDetail'])->name('jahit.updateDetail');
            // delete detail
            Route::delete('detail-data/delete/{id}', [JahitController::class, 'deleteInsertorEdit'])->name('jahit.deleteInsertEdit');
            // delete jahit
            Route::delete('delete/{kode_jahit}', [JahitController::class, 'destroy'])->name('jahit.delete');
            // Confirm & Finishing
            Route::put('confirm-work/{kode_jahit}', [JahitController::class, 'confirm'])->name('jahit.confirm');
            Route::put('finished-work/{kode_jahit}', [JahitController::class, 'finished'])->name('jahit.finished');

            Route::get('detail-karyawan/{kode_jahit}', [JahitController::class, 'detailFormKaryawan'])->name('jahit.detailKaryawan');
            Route::put('tambah-karyawan/{id}', [JahitController::class, 'addKaryawanJahit'])->name('jahit.addKaryawan');
            Route::put('update-karyawan/{id}', [JahitController::class, 'updateKaryawanJahit'])->name('jahit.updateKaryawan');
        });

        // Route Finishing
        Route::group(['prefix' => 'finishing'], function () {
            // index
            Route::get('', [FinishingController::class, 'index'])->name('finishing');
            Route::get('data/{status}', [FinishingController::class, 'indexData'])->name('finishing.data');
            // create
            Route::get('tambah-data', [FinishingController::class, 'insert'])->name('finishing.insert');
            Route::post('tambah-data', [FinishingController::class, 'store'])->name('finishing.store');
            // edit
            Route::get('edit-data/{uuid}', [FinishingController::class, 'edit'])->name('finishing.edit');
            Route::post('edit-data', [FinishingController::class, 'update'])->name('finishing.update');
            Route::post('edit-detail', [FinishingController::class, 'updateDetail'])->name('finishing.updateDetail');
            // delete detail
            Route::delete('detail-data/delete/{id}', [FinishingController::class, 'deleteInsertorEdit'])->name('finishing.deleteInsertEdit');
            // delete Finishing
            Route::delete('delete/{kode_finishing}', [FinishingController::class, 'destroy'])->name('finishing.delete');
            // Confirm & Finishing
            Route::put('confirm-work/{kode_finishing}', [FinishingController::class, 'confirm'])->name('finishing.confirm');
            Route::put('finished-work/{kode_finishing}', [FinishingController::class, 'finished'])->name('finishing.finished');

            Route::get('detail-karyawan/{kode_finishing}', [FinishingController::class, 'detailFormKaryawan'])->name('finishing.detailKaryawan');
            Route::put('tambah-karyawan/{id}', [FinishingController::class, 'addKaryawanFinishing'])->name('finishing.addKaryawan');
            Route::put('update-karyawan/{id}', [FinishingController::class, 'updateKaryawanFinishing'])->name('finishing.updateKaryawan');
        });

        // Route Barang Jadi
        Route::group(['prefix' => 'barang-jadi'], function () {
            // index
            Route::get('', [BarangJadiController::class, 'index'])->name('barang_jadi');
            Route::get('data/{status}', [BarangJadiController::class, 'indexData'])->name('barang_jadi.data');
            // delete barang_jadi
            Route::delete('delete/{id}', [BarangJadiController::class, 'destroy'])->name('barang_jadi.delete');
            // Confirm & barang_jadi
            Route::put('confirm-work/{id}', [BarangJadiController::class, 'confirm'])->name('barang_jadi.confirm');
        });

        // Route Pemasukkan
        Route::group(['prefix' => 'pemasukkan'], function () {
            // index
            Route::get('',  [PemasukkanController::class, 'index'])->name('pemasukkan');
            Route::get('data', [PemasukkanController::class, 'indexData'])->name('pemasukkan.data');
            Route::post('search-data', [PemasukkanController::class, 'indexData'])->name('pemasukkan.searchData');
            Route::post('search-data-pemasukkan', [PemasukkanController::class, 'indexDataPemasukkan'])->name('pemasukkan.searchPemasukkan');
            // Insert
            Route::get('tambah-data',  [PemasukkanController::class, 'insert'])->name('pemasukkan.insert');
            Route::post('tambah-data',  [PemasukkanController::class, 'store'])->name('pemasukkan.store');
            // edit
            Route::get('edit-data/{uuid}',  [PemasukkanController::class, 'edit'])->name('pemasukkan.edit');
            Route::post('edit-data',  [PemasukkanController::class, 'update'])->name('pemasukkan.update');
            // confirm
            Route::put('konfirmasi-data/{kode_pemasukkan}',  [PemasukkanController::class, 'confirmData'])->name('pemasukkan.konfirmasi');
            // delete
            Route::delete('delete/{uuid}', [PemasukkanController::class, 'destroy'])->name('pemasukkan.delete');
            Route::delete('delete-detail/{uuid}', [PemasukkanController::class, 'destroyDetail'])->name('pemasukkan.deleteDetail');
        });

        // Route Pengeluaran
        Route::group(['prefix' => 'pengeluaran'], function () {
            // index
            Route::get('',  [PengeluaranController::class, 'index'])->name('pengeluaran');
            Route::get('data', [PengeluaranController::class, 'indexData'])->name('pengeluaran.data');
            Route::post('search-data', [PengeluaranController::class, 'indexData'])->name('pengeluaran.searchData');
            Route::post('search-data-pengeluaran', [PengeluaranController::class, 'indexDataPengeluaran'])->name('pengeluaran.searchPengeluaran');
            // Insert
            Route::get('tambah-data',  [PengeluaranController::class, 'insert'])->name('pengeluaran.insert');
            Route::post('tambah-data',  [PengeluaranController::class, 'store'])->name('pengeluaran.store');
            // edit
            Route::get('edit-data/{uuid}',  [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
            Route::post('edit-data',  [PengeluaranController::class, 'update'])->name('pengeluaran.update');
            // confirm
            Route::put('konfirmasi-data/{kode_pengeluaran}',  [PengeluaranController::class, 'confirmData'])->name('pengeluaran.konfirmasi');
            // delete
            Route::delete('delete/{uuid}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.delete');
            Route::delete('delete-detail/{uuid}', [PengeluaranController::class, 'destroyDetail'])->name('pengeluaran.deleteDetail');
        });

        // Route Transaksi Gaji
        Route::group(['prefix' => 'pengeluaran-gaji'], function () {
            Route::get('', [TransaksiGajiController::class, 'index'])->name('tgaji');
            Route::get('data', [TransaksiGajiController::class, 'indexData'])->name('tgaji.data');
            Route::post('', [TransaksiGajiController::class, 'indexData'])->name('tgaji.searchData');
            Route::put('konfirmasi-gaji/{sp}/{id}', [TransaksiGajiController::class, 'confirmGaji'])->name('tgaji.confirm');
        });
    });

    // ***** ADMIN ROLE ***** //
    Route::group(['roles' => 'Admin', 'prefix' => 'admin'], function () {
        // Module Ukuran
        Route::group(['prefix' => 'ukuran'], function () {
            Route::get('', [UkuranController::class, 'index'])->name('a.ukuran');
            Route::get('data', [UkuranController::class, 'indexData'])->name('a.ukuran.data');
            Route::post('', [UkuranController::class, 'store'])->name('a.ukuran.add');
            Route::get('{uuid}', [UkuranController::class, 'edit'])->name('a.ukuran.edit');
            Route::put('{uuid}', [UkuranController::class, 'update'])->name('a.ukuran.update');
            Route::delete('{uuid}', [UkuranController::class, 'delete'])->name('a.ukuran.delete');
        });

        // Module Gaji
        Route::group(['prefix' => 'gaji'], function () {
            Route::get('', [GajiController::class, 'index'])->name('a.gaji');
            Route::get('data', [GajiController::class, 'indexData'])->name('a.gaji.data');
            Route::post('', [GajiController::class, 'store'])->name('a.gaji.add');
            Route::get('{uuid}', [GajiController::class, 'edit'])->name('a.gaji.edit');
            Route::put('{uuid}', [GajiController::class, 'update'])->name('a.gaji.update');
            Route::delete('{uuid}', [GajiController::class, 'delete'])->name('a.gaji.delete');
        });

        //Route Module Karyawan
        Route::group(['prefix' => 'karyawan'], function () {
            Route::get('', [KaryawanController::class, 'index'])->name('a.karyawan');
            Route::get('data', [KaryawanController::class, 'indexData'])->name('a.karyawan.data');
            Route::post('', [KaryawanController::class, 'addData'])->name('a.karyawan.add');
            Route::get('{uuid}', [KaryawanController::class, 'detailData'])->name('a.karyawan.detail');
            Route::put('{uuid}', [KaryawanController::class, 'updateData'])->name('a.karyawan.update');
            Route::delete('{uuid}', [KaryawanController::class, 'deleteData'])->name('a.karyawan.delete');
        });

        //Route Module Perlengkapan
        Route::group(['prefix' => 'perlengkapan'], function () {
            Route::get('', [PerlengkapanController::class, 'index'])->name('a.perlengkapan');
            Route::get('data', [PerlengkapanController::class, 'indexData'])->name('a.perlengkapan.data');
            Route::post('', [PerlengkapanController::class, 'addData'])->name('a.perlengkapan.add');
            Route::get('{uuid}', [PerlengkapanController::class, 'detailData'])->name('a.perlengkapan.detail');
            Route::put('{uuid}', [PerlengkapanController::class, 'updateData'])->name('a.perlengkapan.update');
            Route::delete('{uuid}', [PerlengkapanController::class, 'deleteData'])->name('a.perlengkapan.delete');
        });

        //Route Module Aset
        Route::group(['prefix' => 'aset'], function () {
            Route::get('', [AsetController::class, 'index'])->name('a.aset');
            Route::get('data', [AsetController::class, 'indexData'])->name('a.aset.data');
            Route::post('', [AsetController::class, 'addData'])->name('a.aset.add');
            Route::get('{uuid}', [AsetController::class, 'detailData'])->name('a.aset.detail');
            Route::put('{uuid}', [AsetController::class, 'updateData'])->name('a.aset.update');
            Route::delete('{uuid}', [AsetController::class, 'deleteData'])->name('a.aset.delete');
        });

        // Route Film Sablon
        Route::group(['prefix' => 'Film-Sablon'], function () {
            Route::get('/', [FilmSablonController::class, 'index'])->name('a.filmSablon');
            Route::get('/get-data', [FilmSablonController::class, 'indexData'])->name('a.filmSablon.Data');
        });

        // Route Finishing
        Route::group(['prefix' => 'finishing'], function () {
            // index
            Route::get('', [FinishingController::class, 'index'])->name('a.finishing');
            Route::get('data/{status}', [FinishingController::class, 'indexData'])->name('a.finishing.data');
            // create
            Route::get('tambah-data', [FinishingController::class, 'insert'])->name('a.finishing.insert');
            Route::post('tambah-data', [FinishingController::class, 'store'])->name('a.finishing.store');
            // edit
            Route::get('edit-data/{uuid}', [FinishingController::class, 'edit'])->name('a.finishing.edit');
            Route::post('edit-data', [FinishingController::class, 'update'])->name('a.finishing.update');
            Route::post('edit-detail', [FinishingController::class, 'updateDetail'])->name('a.finishing.updateDetail');
            // delete detail
            Route::delete('detail-data/delete/{id}', [FinishingController::class, 'deleteInsertorEdit'])->name('a.finishing.deleteInsertEdit');
            // delete Finishing
            Route::delete('delete/{kode_finishing}', [FinishingController::class, 'destroy'])->name('a.finishing.delete');
            // Confirm & Finishing
            Route::put('confirm-work/{kode_finishing}', [FinishingController::class, 'confirm'])->name('a.finishing.confirm');
            Route::put('finished-work/{kode_finishing}', [FinishingController::class, 'finished'])->name('a.finishing.finished');

            Route::get('detail-karyawan/{kode_finishing}', [FinishingController::class, 'detailFormKaryawan'])->name('a.finishing.detailKaryawan');
            Route::put('tambah-karyawan/{id}', [FinishingController::class, 'addKaryawanFinishing'])->name('a.finishing.addKaryawan');
            Route::put('update-karyawan/{id}', [FinishingController::class, 'updateKaryawanFinishing'])->name('a.finishing.updateKaryawan');
        });

        // Route Barang Jadi
        Route::group(['prefix' => 'barang-jadi'], function () {
            // index
            Route::get('', [BarangJadiController::class, 'index'])->name('a.barang_jadi');
            Route::get('data/{status}', [BarangJadiController::class, 'indexData'])->name('a.barang_jadi.data');
            // delete barang_jadi
            Route::delete('delete/{id}', [BarangJadiController::class, 'destroy'])->name('a.barang_jadi.delete');
            // Confirm & barang_jadi
            Route::put('confirm-work/{id}', [BarangJadiController::class, 'confirm'])->name('a.barang_jadi.confirm');
        });

        // Route Pemasukkan
        Route::group(['prefix' => 'pemasukkan'], function () {
            // index
            Route::get('',  [PemasukkanController::class, 'index'])->name('a.pemasukkan');
            Route::get('data', [PemasukkanController::class, 'indexData'])->name('a.pemasukkan.data');
            Route::post('search-data', [PemasukkanController::class, 'indexData'])->name('a.pemasukkan.searchData');
            Route::post('search-data-pemasukkan', [PemasukkanController::class, 'indexDataPemasukkan'])->name('a.pemasukkan.searchPemasukkan');
            // Insert
            Route::get('tambah-data',  [PemasukkanController::class, 'insert'])->name('a.pemasukkan.insert');
            Route::post('tambah-data',  [PemasukkanController::class, 'store'])->name('a.pemasukkan.store');
            // edit
            Route::get('edit-data/{uuid}',  [PemasukkanController::class, 'edit'])->name('a.pemasukkan.edit');
            Route::post('edit-data',  [PemasukkanController::class, 'update'])->name('a.pemasukkan.update');
            // confirm
            Route::put('konfirmasi-data/{kode_pemasukkan}',  [PemasukkanController::class, 'confirmData'])->name('a.pemasukkan.konfirmasi');
            // delete
            Route::delete('delete/{uuid}', [PemasukkanController::class, 'destroy'])->name('a.pemasukkan.delete');
            Route::delete('delete-detail/{uuid}', [PemasukkanController::class, 'destroyDetail'])->name('a.pemasukkan.deleteDetail');
        });

        // Route Pengeluaran
        Route::group(['prefix' => 'pengeluaran'], function () {
            // index
            Route::get('',  [PengeluaranController::class, 'index'])->name('a.pengeluaran');
            Route::get('data', [PengeluaranController::class, 'indexData'])->name('a.pengeluaran.data');
            Route::post('search-data', [PengeluaranController::class, 'indexData'])->name('a.pengeluaran.searchData');
            Route::post('search-data-pengeluaran', [PengeluaranController::class, 'indexDataPengeluaran'])->name('a.pengeluaran.searchPengeluaran');
            // Insert
            Route::get('tambah-data',  [PengeluaranController::class, 'insert'])->name('a.pengeluaran.insert');
            Route::post('tambah-data',  [PengeluaranController::class, 'store'])->name('a.pengeluaran.store');
            // edit
            Route::get('edit-data/{uuid}',  [PengeluaranController::class, 'edit'])->name('a.pengeluaran.edit');
            Route::post('edit-data',  [PengeluaranController::class, 'update'])->name('a.pengeluaran.update');
            // confirm
            Route::put('konfirmasi-data/{kode_pengeluaran}',  [PengeluaranController::class, 'confirmData'])->name('a.pengeluaran.konfirmasi');
            // delete
            Route::delete('delete/{uuid}', [PengeluaranController::class, 'destroy'])->name('a.pengeluaran.delete');
            Route::delete('delete-detail/{uuid}', [PengeluaranController::class, 'destroyDetail'])->name('a.pengeluaran.deleteDetail');
        });

        // Route Transaksi Gaji
        Route::group(['prefix' => 'pengeluaran-gaji'], function () {
            Route::get('', [TransaksiGajiController::class, 'index'])->name('a.tgaji');
            Route::get('data', [TransaksiGajiController::class, 'indexData'])->name('a.tgaji.data');
            Route::post('', [TransaksiGajiController::class, 'indexData'])->name('a.tgaji.searchData');
            Route::put('konfirmasi-gaji/{sp}/{id}', [TransaksiGajiController::class, 'confirmGaji'])->name('a.tgaji.confirm');
        });
    });

    // ***** Warehouse ROLE ***** //
    Route::group(['roles' => 'Warehouse', 'prefix' => 'warehouse'], function () {
        //Route Module Kain Roll
        Route::group(['prefix' => 'kain-roll'], function () {
            Route::get('', [KainRollController::class, 'index'])->name('w.kain_roll');
            Route::get('data', [KainRollController::class, 'indexData'])->name('w.kain_roll.data');
            Route::post('', [KainRollController::class, 'addData'])->name('w.kain_roll.add');
            Route::get('{uuid}', [KainRollController::class, 'detailData'])->name('w.kain_roll.detail');
            Route::put('{uuid}', [KainRollController::class, 'updateData'])->name('w.kain_roll.update');
            Route::delete('{uuid}', [KainRollController::class, 'deleteData'])->name('w.kain_roll.delete');
        });

        // Route Module Kain Potongan
        Route::group(['prefix' => 'kain-potongan'], function () {
            Route::get('', [KainPotonganController::class, 'index'])->name('w.kain_potongan');
            Route::get('data', [KainPotonganController::class, 'indexData'])->name('w.kain_potongan.data');
            Route::post('', [KainPotonganController::class, 'store'])->name('w.kain_potongan.add');
            Route::get('{uuid}', [KainPotonganController::class, 'detail'])->name('w.kain_potongan.detail');
            Route::put('{uuid}', [KainPotonganController::class, 'update'])->name('w.kain_potongan.update');
            Route::delete('{uuid}', [KainPotonganController::class, 'delete'])->name('w.kain_potongan.delete');
        });

        // Route SPP
        Route::group(['prefix' => 'surat-perintah-potong'], function () {
            Route::get('', [SPPController::class, 'index'])->name('w.spp');
            Route::get('data', [SPPController::class, 'indexData'])->name('w.spp.data');
            // create
            Route::get('tambah-data', [SPPController::class, 'insert'])->name('w.spp.insert');
            Route::post('tambah-data', [SPPController::class, 'store'])->name('w.spp.store');
            // edit
            Route::get('edit-data/{uuid}', [SPPController::class, 'edit'])->name('w.spp.edit');
            Route::post('edit-data', [SPPController::class, 'update'])->name('w.spp.update');
            // delete detail
            Route::delete('detail-data/delete/{id}', [SPPController::class, 'deleteInsertorEdit'])->name('w.spp.deleteInsertEdit');
            // delete spp
            Route::delete('delete/{kode_spp}', [SPPController::class, 'destroy'])->name('w.spp.delete');
            // Confirm & Finishing
            Route::put('confirm-work/{kode_spp}', [SPPController::class, 'confirm'])->name('w.spp.confirm');
            Route::put('finished-work/{kode_spp}', [SPPController::class, 'finished'])->name('w.spp.finished');
            // get spp for SPK
            Route::get('data/{kode_spp}', [SPPController::class, 'dataSPP'])->name('w.spp.getData');
            // Print SPP
            Route::get('print-data/{uuid}', [SPPController::class, 'cetakPdf'])->name('w.spp.cetakPdf');
        });

        // Route SPK
        Route::group(['prefix' => 'surat-perintah-kerja'], function () {
            // getArticle
            Route::get('artikel/{artikel}', [SPKController::class, 'getArtikel'])->name('w.spk.artikel');
            // get Hasil Potongan
            Route::get('hasil-potongan/{kode_spp}/{ukuran}/{warna}', [SPKController::class, 'getHasilPotongan'])->name('w.spk.hasilPotongan');
            // index
            Route::get('', [SPKController::class, 'index'])->name('w.spk');
            Route::get('data', [SPKController::class, 'indexData'])->name('w.spk.data');
            // create
            Route::get('tambah-data', [SPKController::class, 'insert'])->name('w.spk.insert');
            Route::post('tambah-data', [SPKController::class, 'store'])->name('w.spk.store');
            // save image
            Route::post('tambah-gambar', [SPKController::class, 'storeGambar'])->name('w.spk.storeGambar');

            // edit
            Route::get('edit-data/{uuid}', [SPKController::class, 'edit'])->name('w.spk.edit');
            Route::post('edit-data', [SPKController::class, 'update'])->name('w.spk.update');
            Route::post('edit-detail', [SPKController::class, 'updateDetail'])->name('w.spk.updateDetail');
            // delete detail
            Route::delete('detail-data/delete/{id}', [SPKController::class, 'deleteInsertorEdit'])->name('w.spk.deleteInsertEdit');
            // delete spk
            Route::delete('delete/{kode_spk}', [SPKController::class, 'destroy'])->name('w.spk.delete');
            // delete gambar
            Route::delete('delete-gambar-spk/{uuid}', [SPKController::class, 'destroyImage'])->name('w.spk.deleteImage');
            // delete detail SPK
            Route::delete('delete-detail-spk/{id}', [SPKController::class, 'destroyDetail'])->name('w.spk.deleteDetail');

            // Confirm & Finishing
            Route::put('confirm-work/{kode_spk}', [SPKController::class, 'confirm'])->name('w.spk.confirm');
            Route::put('finished-work/{kode_spk}', [SPKController::class, 'finished'])->name('w.spk.finished');
            
            // Print SPK
            Route::get('print-data/{uuid}', [SPKController::class, 'cetakPdf'])->name('w.spk.cetakPdf');
        });

        // Route Jahit
        Route::group(['prefix' => 'jahit'], function () {
            // get artikel spk
            Route::get('getArtikelFromSPK/{kode_spk}', [JahitController::class, 'getArtikelFromSPK'])->name('w.getArtikelSpk');
            Route::get('getQuantityArtikel/{id}', [JahitController::class, 'getQuantityArtikel'])->name('w.getQuantityArtikel');
            // index
            Route::get('', [JahitController::class, 'index'])->name('w.jahit');
            Route::get('data/{status}', [JahitController::class, 'indexData'])->name('w.jahit.data');
            // create
            Route::get('tambah-data', [JahitController::class, 'insert'])->name('w.jahit.insert');
            Route::post('tambah-data', [JahitController::class, 'store'])->name('w.jahit.store');
            // edit
            Route::get('edit-data/{uuid}', [JahitController::class, 'edit'])->name('w.jahit.edit');
            Route::post('edit-data', [JahitController::class, 'update'])->name('w.jahit.update');
            Route::post('edit-detail', [JahitController::class, 'updateDetail'])->name('w.jahit.updateDetail');
        });

        // Route Finishing
        Route::group(['prefix' => 'finishing'], function () {
            // index
            Route::get('', [FinishingController::class, 'index'])->name('w.finishing');
            Route::get('data/{status}', [FinishingController::class, 'indexData'])->name('w.finishing.data');
            // create
            Route::get('tambah-data', [FinishingController::class, 'insert'])->name('w.finishing.insert');
            Route::post('tambah-data', [FinishingController::class, 'store'])->name('w.finishing.store');
            // edit
            Route::get('edit-data/{uuid}', [FinishingController::class, 'edit'])->name('w.finishing.edit');
            Route::post('edit-data', [FinishingController::class, 'update'])->name('w.finishing.update');
            Route::post('edit-detail', [FinishingController::class, 'updateDetail'])->name('w.finishing.updateDetail');
        });

        // Route Barang Jadi
        Route::group(['prefix' => 'barang-jadi'], function () {
            // index
            Route::get('', [BarangJadiController::class, 'index'])->name('w.barang_jadi');
            Route::get('data/{status}', [BarangJadiController::class, 'indexData'])->name('w.barang_jadi.data');
        });
    });
});

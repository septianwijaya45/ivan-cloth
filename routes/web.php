<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\KainRollController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerlengkapanController;
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

//Route Module Kain Roll
Route::get('kain_roll', [KainRollController::class, 'index'])->name('kain_roll');
Route::get('kain_roll/data', [KainRollController::class, 'indexData'])->name('kain_roll.data');
Route::post('kain_roll', [KainRollController::class, 'addData'])->name('kain_roll.add');
Route::get('kain_roll/{uuid}', [KainRollController::class, 'detailData'])->name('kain_roll.detail');
Route::put('kain_roll/{uuid}', [KainRollController::class, 'updateData'])->name('kain_roll.update');
Route::delete('kain_roll/{uuid}', [KainRollController::class, 'deleteData'])->name('kain_roll.delete');

//Route Module Karyawan
Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::get('karyawan/data', [KaryawanController::class, 'indexData'])->name('karyawan.data');
Route::post('karyawan', [KaryawanController::class, 'addData'])->name('karyawan.add');
Route::get('karyawan/{uuid}', [KaryawanController::class, 'detailData'])->name('karyawan.detail');
Route::put('karyawan/{uuid}', [KaryawanController::class, 'updateData'])->name('karyawan.update');
Route::delete('karyawan/{uuid}', [KaryawanController::class, 'deleteData'])->name('karyawan.delete');

//Route Module Perlengkapan
Route::get('perlengkapan', [PerlengkapanController::class, 'index'])->name('perlengkapan');
Route::get('perlengkapan/data', [PerlengkapanController::class, 'indexData'])->name('perlengkapan.data');
Route::post('perlengkapan', [PerlengkapanController::class, 'addData'])->name('perlengkapan.add');
Route::get('perlengkapan/{uuid}', [PerlengkapanController::class, 'detailData'])->name('perlengkapan.detail');
Route::put('perlengkapan/{uuid}', [PerlengkapanController::class, 'updateData'])->name('perlengkapan.update');
Route::delete('perlengkapan/{uuid}', [PerlengkapanController::class, 'deleteData'])->name('perlengkapan.delete');

//Route Module Aset
Route::get('aset', [AsetController::class, 'index'])->name('aset');
Route::get('aset/data', [AsetController::class, 'indexData'])->name('aset.data');
Route::post('aset', [AsetController::class, 'addData'])->name('aset.add');
Route::get('aset/{uuid}', [AsetController::class, 'detailData'])->name('aset.detail');
Route::put('aset/{uuid}', [AsetController::class, 'updateData'])->name('aset.update');
Route::delete('aset/{uuid}', [AsetController::class, 'deleteData'])->name('aset.delete');

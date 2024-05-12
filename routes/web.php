<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransactionController;

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

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login')->middleware('guest');
    Route::post('login/access', 'authenticate');
    Route::get('logout', 'logout');
});

Route::group(['middleware' => 'auth'], function () {

    // Route::get('/', function () {
    //     return view('templates.home', [
    //         'title' => 'Dashboard'
    //     ]);
    // });

    // Route::get('info', function () {
    //     return view('templates.info', [
    //         'title' => 'Tentang Aplikasi'
    //     ]);
    // });



    Route::resource('kategori', KategoriController::class);
    Route::get('export/kategori', [KategoriController::class, 'exportData'])->name('export-kategori');
    Route::post('kategori/import', [KategoriController::class, 'importData'])->name('import-kategori');
    Route::get('cetak/kategori', [KategoriController::class, 'cetakPDF'])->name('cetak-kategori');
    Route::resource('jenis', JenisController::class);
    Route::get('export/jenis', [JenisController::class, 'exportData'])->name('export-jenis');
    Route::post('import/jenis', [JenisController::class, 'importData'])->name('import-jenis');
    Route::get('cetak/jenis', [JenisController::class, 'cetakPDF'])->name('cetak-jenis');
    Route::resource('user', UserController::class);
    Route::resource('menu', MenuController::class);
    Route::get('export/menu', [MenuController::class, 'exportData'])->name('export-menu');
    Route::post('import/menu', [MenuController::class, 'importData'])->name('import-menu');
    Route::get('cetak/menu', [MenuController::class, 'cetakPDF'])->name('cetak-menu');
    Route::resource('stok', StockController::class);
    Route::get('export/stok', [StockController::class, 'exportData'])->name('export-stok');
    Route::post('import/stok', [StockController::class, 'importData'])->name('import-stok');
    Route::get('cetak/stok', [StockController::class, 'cetakPDF'])->name('cetak-stok');
    Route::resource('meja', TableController::class);
    Route::get('export/meja', [TableController::class, 'exportData'])->name('export-meja');
    Route::post('import/meja', [TableController::class, 'importData'])->name('import-meja');
    Route::get('cetak/meja', [TableController::class, 'cetakPDF'])->name('cetak-meja');
    Route::get('/', [GrafikController::class, 'index']);
    Route::resource('pelanggan', CustomerController::class);
    Route::get('export/pelanggan', [CustomerController::class, 'exportData'])->name('export-pelanggan');
    Route::post('import/pelanggan', [CustomerController::class, 'importData'])->name('import-pelanggan');
    Route::get('cetak/pelanggan', [CustomerController::class, 'cetakPDF'])->name('cetak-pelanggan');
    // Route::resource('absensi', AbsensiController::class);
    // Route::resource('produk', ProdukController::class);
    // Route::put('produk/{id}', [ProdukController::class, 'update'])->name('update.stock');

    Route::resource('transaksi', TransactionController::class);
    Route::get('nota/{nofaktur}', [TransactionController::class, 'faktur']);

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('filter', [LaporanController::class, 'filter']);
    Route::get('cetak/laporan/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('cetak-laporan');

    Route::get('grafik', [GrafikController::class, 'index']);
});


// Route::get('/login', function() {
//     return view('login');
// });

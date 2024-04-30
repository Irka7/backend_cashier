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
    Route::resource('jenis', JenisController::class);
    Route::resource('user', UserController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('stok', StockController::class);
    Route::resource('meja', TableController::class);
    Route::get('/', [GrafikController::class, 'index']);
    // Route::resource('absensi', AbsensiController::class);
    // Route::resource('produk', ProdukController::class);
    // Route::put('produk/{id}', [ProdukController::class, 'update'])->name('update.stock');

    Route::resource('transaksi', TransactionController::class);
    Route::get('nota/{nofaktur}', [TransactionController::class, 'faktur']);

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');

    // Route::post('grafik', [GrafikController::class, 'store']);
});


// Route::get('/login', function() {
//     return view('login');
// });

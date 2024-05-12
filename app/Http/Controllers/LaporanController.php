<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Http\Requests\StoreLaporanRequest;
use App\Http\Requests\UpdateLaporanRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $akhir = date('Y-m-d');

        // if ($request->has('awal') && $request->awal != "" && $request->has('akhir') && $request->akhir) {
        //     $tanggalAwal = $request->awal;
        //     $tanggalAkhir = $request->akhir;
        // }

    $data['transaksi'] = Transaction::orderBy('tanggal', 'DESC')->get();

        return view('laporan.index', compact('awal', 'akhir') ,[ 'title' => 'Laporan'])->with($data);
    }

    public function filter(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;

        $data['transaksi'] = Transaction::whereDate('tanggal', '>=', $awal)->whereDate('tanggal', '<=', $akhir)->get();

        return view('laporan.index',compact('awal', 'akhir'), ['title' => 'Laporan'])->with($data);
    }

    public function exportPDF($awal, $akhir)
    {
        // dd("Awal : ".$awal, "Akhir : ".$akhir);
        $data['transaksi'] = Transaction::whereBetween('tanggal', [$awal, $akhir])->get();
        return view('laporan.cetak', [ 'title' => 'Pendapatan' ])->with($data);
    }
}
